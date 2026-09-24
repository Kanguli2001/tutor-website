<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Payout;
use App\Models\Review;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManagementController extends Controller
{
    public function tutor(Request $request): View
    {
        $this->ensureRole($request, 'tutor');

        return view('management.tutor', ['courses' => Course::withCount('enrollments')->with('modules.lessons')->latest()->get()]);
    }

    public function createCourse(Request $request): View
    {
        $this->ensureRole($request, 'tutor');

        return view('management.course-form');
    }

    public function storeCourse(Request $request): RedirectResponse
    {
        $this->ensureRole($request, 'tutor');
        $data = $request->validate(['title' => ['required', 'string', 'max:160'], 'slug' => ['required', 'alpha_dash', 'unique:courses,slug'], 'category' => ['required', 'string', 'max:80'], 'description' => ['required', 'string'], 'level' => ['required', 'string'], 'price_cents' => ['required', 'integer', 'min:0']]);
        $course = Course::create($data + ['status' => 'draft', 'instructor_id' => $request->user()->id]);

        return redirect()->route('tutor.dashboard')->with('status', "Course {$course->title} created as a draft.");
    }

    public function updateCourse(Request $request, Course $course): RedirectResponse
    {
        $this->ensureRole($request, 'tutor');
        $course->update($request->validate(['title' => ['required', 'string', 'max:160'], 'description' => ['required', 'string'], 'status' => ['required', 'in:draft,pending,published']]));

        return back()->with('status', 'Course updated.');
    }

    public function deleteCourse(Request $request, Course $course): RedirectResponse
    {
        $this->ensureRole($request, 'tutor');
        $course->delete();

        return back()->with('status', 'Course deleted.');
    }

    public function storeLesson(Request $request, Course $course): RedirectResponse
    {
        $this->ensureRole($request, 'tutor');
        $data = $request->validate(['module_id' => ['required', 'exists:modules,id'], 'title' => ['required', 'string', 'max:160'], 'content_type' => ['required', 'in:text,video'], 'content' => ['nullable', 'string'], 'video_url' => ['nullable', 'url'], 'duration_minutes' => ['required', 'integer', 'min:1']]);
        Lesson::create($data + ['position' => $course->modules()->findOrFail($data['module_id'])->lessons()->max('position') + 1]);

        return back()->with('status', 'Lesson added.');
    }

    public function storeModule(Request $request, Course $course): RedirectResponse
    {
        $this->ensureRole($request, 'tutor');
        $data = $request->validate(['title' => ['required', 'string', 'max:160']]);
        $course->modules()->create($data + ['position' => $course->modules()->max('position') + 1]);

        return back()->with('status', 'Module added.');
    }

    public function updateModule(Request $request, Module $module): RedirectResponse
    {
        $this->ensureRole($request, 'tutor');
        $module->update($request->validate(['title' => ['required', 'string', 'max:160']]));

        return back()->with('status', 'Module updated.');
    }

    public function deleteModule(Request $request, Module $module): RedirectResponse
    {
        $this->ensureRole($request, 'tutor');
        $module->delete();

        return back()->with('status', 'Module deleted.');
    }

    public function updateLesson(Request $request, Lesson $lesson): RedirectResponse
    {
        $this->ensureRole($request, 'tutor');
        $lesson->update($request->validate(['title' => ['required', 'string', 'max:160'], 'content_type' => ['required', 'in:text,video'], 'content' => ['nullable', 'string'], 'video_url' => ['nullable', 'url'], 'duration_minutes' => ['required', 'integer', 'min:1'], 'is_published' => ['nullable', 'boolean']]));

        return back()->with('status', 'Lesson updated.');
    }

    public function deleteLesson(Request $request, Lesson $lesson): RedirectResponse
    {
        $this->ensureRole($request, 'tutor');
        $lesson->delete();

        return back()->with('status', 'Lesson deleted.');
    }

    public function users(Request $request): View
    {
        $this->ensureRole($request, 'admin');

        return view('management.users', ['users' => User::withCount('enrollments')->latest()->paginate(20)]);
    }

    public function updateUserRole(Request $request, User $user): RedirectResponse
    {
        $this->ensureRole($request, 'admin');
        $user->update($request->validate(['role' => ['required', 'in:student,tutor,admin']]));

        return back()->with('status', 'User role updated.');
    }

    public function deleteUser(Request $request, User $user): RedirectResponse
    {
        $this->ensureRole($request, 'admin');
        abort_if($request->user()->is($user), 422, 'You cannot delete your own admin account.');
        $user->delete();

        return back()->with('status', 'User deleted.');
    }

    public function approveCourse(Request $request, Course $course): RedirectResponse
    {
        $this->ensureRole($request, 'admin');
        $course->update(['approval_status' => 'approved', 'status' => 'published']);

        return back()->with('status', 'Course approved and published.');
    }

    public function analytics(Request $request): View
    {
        $this->ensureRole($request, 'admin');

        $months = collect(range(5, 0))->map(function (int $monthsAgo): array {
            $month = CarbonImmutable::now()->subMonths($monthsAgo)->startOfMonth();
            $nextMonth = $month->addMonth();

            return [
                'label' => $month->format('M'),
                'users' => User::whereBetween('created_at', [$month, $nextMonth])->count(),
                'enrollments' => Enrollment::whereBetween('enrolled_at', [$month, $nextMonth])->count(),
                'revenue' => (int) Course::join('enrollments', 'courses.id', '=', 'enrollments.course_id')
                    ->whereBetween('enrollments.enrolled_at', [$month, $nextMonth])
                    ->sum('courses.price_cents'),
            ];
        });

        return view('management.analytics', ['users' => User::count(), 'courses' => Course::count(), 'enrollments' => Enrollment::count(), 'revenue' => Course::join('enrollments', 'courses.id', '=', 'enrollments.course_id')->sum('price_cents'), 'chartData' => $months]);
    }

    public function tutorAnalytics(Request $request): View
    {
        $this->ensureRole($request, 'tutor');
        $courses = Course::where('instructor_id', $request->user()->id)->withCount('enrollments')->get();

        return view('management.tutor-analytics', ['courses' => $courses, 'payouts' => Payout::whereBelongsTo($request->user())->latest()->get()]);
    }

    public function categories(Request $request): View
    {
        $this->ensureRole($request, 'admin');

        return view('management.categories', ['categories' => Category::latest()->get()]);
    }

    public function storeCategory(Request $request): RedirectResponse
    {
        $this->ensureRole($request, 'admin');
        $data = $request->validate(['name' => ['required', 'string', 'max:80'], 'slug' => ['required', 'alpha_dash', 'unique:categories,slug']]);
        Category::create($data);

        return back()->with('status', 'Category added.');
    }

    public function updateCategory(Request $request, Category $category): RedirectResponse
    {
        $this->ensureRole($request, 'admin');
        $category->update($request->validate(['name' => ['required', 'string', 'max:80'], 'slug' => ['required', 'alpha_dash', 'unique:categories,slug,'.$category->id]]));

        return back()->with('status', 'Category updated.');
    }

    public function deleteCategory(Request $request, Category $category): RedirectResponse
    {
        $this->ensureRole($request, 'admin');
        $category->delete();

        return back()->with('status', 'Category deleted.');
    }

    public function moderateReview(Request $request, Review $review): RedirectResponse
    {
        $this->ensureRole($request, 'admin');
        $review->delete();

        return back()->with('status', 'Review removed.');
    }

    public function updateMessage(Request $request, int $message): RedirectResponse
    {
        $this->ensureRole($request, 'admin');
        ContactMessage::whereKey($message)->update(['status' => $request->validate(['status' => ['required', 'in:new,in_progress,resolved']])['status']]);

        return back()->with('status', 'Support message updated.');
    }

    private function ensureRole(Request $request, string $role): void
    {
        abort_unless(in_array($request->user()->role, [$role, 'admin'], true), 403);
    }

    public function admin(Request $request): View
    {
        $this->ensureRole($request, 'admin');

        return view('management.admin', ['courses' => Course::withCount('reviews')->latest()->get(), 'messages' => ContactMessage::latest()->get(), 'reviews' => Review::with(['course', 'user'])->latest()->get()]);
    }
}
