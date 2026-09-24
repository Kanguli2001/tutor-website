<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\LessonProgress;
use App\Models\Review;
use App\Notifications\CourseCompletedNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class LearningController extends Controller
{
    public function dashboard(Request $request): View
    {
        return view('learning.index', ['enrollments' => $request->user()->enrollments()->with('course')->latest('enrolled_at')->get()]);
    }

    public function checkout(Course $course): View
    {
        return view('learning.checkout', compact('course'));
    }

    public function enroll(Request $request, Course $course): RedirectResponse
    {
        Enrollment::updateOrCreate(['user_id' => $request->user()->id, 'course_id' => $course->id], ['progress' => 0, 'enrolled_at' => now()]);

        return redirect()->route('learning.course', $course)->with('status', 'You are enrolled in this course.');
    }

    public function course(Request $request, Course $course): View
    {
        $enrollment = $request->user()->enrollments()->whereBelongsTo($course)->firstOrFail();

        return view('learning.course', ['course' => $course->load('modules.lessons'), 'enrollment' => $enrollment, 'completedLessons' => $request->user()->lessonProgress()->whereNotNull('completed_at')->pluck('lesson_id')]);
    }

    public function completeLesson(Request $request, Course $course, Lesson $lesson): RedirectResponse
    {
        abort_unless($lesson->module()->whereBelongsTo($course)->exists(), 404);
        $enrollment = $request->user()->enrollments()->whereBelongsTo($course)->firstOrFail();
        LessonProgress::updateOrCreate(['user_id' => $request->user()->id, 'lesson_id' => $lesson->id], ['completed_at' => now()]);
        $totalLessons = $course->modules()->withCount('lessons')->get()->sum('lessons_count');
        $completedLessons = $request->user()->lessonProgress()->whereIn('lesson_id', $course->modules()->with('lessons')->get()->flatMap->lessons->pluck('id'))->whereNotNull('completed_at')->count();
        $progress = $totalLessons > 0 ? (int) round(($completedLessons / $totalLessons) * 100) : 100;
        $enrollment->update(['progress' => $progress]);

        if ($progress === 100) {
            Certificate::firstOrCreate(['user_id' => $request->user()->id, 'course_id' => $course->id], ['certificate_number' => 'MWY-'.Str::upper(Str::random(10)), 'issued_at' => now()]);
            $request->user()->notify(new CourseCompletedNotification($course->title));
        }

        return back()->with('status', $progress === 100 ? 'Course complete. Your certificate is ready.' : 'Lesson marked complete.');
    }

    public function complete(Request $request, Course $course): RedirectResponse
    {
        $request->user()->enrollments()->whereBelongsTo($course)->update(['progress' => 100]);

        return back()->with('status', 'Course marked complete.');
    }

    public function review(Request $request, Course $course): RedirectResponse
    {
        $data = $request->validate(['rating' => ['required', 'integer', 'between:1,5'], 'body' => ['required', 'string', 'max:2000']]);
        abort_unless($request->user()->enrollments()->whereBelongsTo($course)->exists(), 403);
        Review::updateOrCreate(['user_id' => $request->user()->id, 'course_id' => $course->id], $data);

        return back()->with('status', 'Thanks for sharing your review.');
    }

    public function certificate(Request $request, Course $course): View
    {
        return view('learning.certificate', ['certificate' => $request->user()->certificates()->whereBelongsTo($course)->firstOrFail(), 'course' => $course]);
    }

    public function verifyCertificate(string $number): View
    {
        return view('learning.verify-certificate', ['certificate' => Certificate::with(['user', 'course'])->where('certificate_number', $number)->first()]);
    }

    public function downloadCertificate(Request $request, Course $course): Response
    {
        $certificate = $request->user()->certificates()->whereBelongsTo($course)->firstOrFail();

        return Pdf::loadView('learning.certificate', compact('certificate', 'course'))
            ->download($certificate->certificate_number.'.pdf');
    }
}
