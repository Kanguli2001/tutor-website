<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class CourseController extends Controller
{
    private function courses(): Collection
    {
        return Course::query()->latest('id')->get()->map(fn (Course $course): array => [
            'slug' => $course->slug,
            'category' => strtoupper($course->category),
            'title' => $course->title,
            'description' => $course->description,
            'level' => $course->level,
            'lessons' => $course->lesson_count,
            'duration' => $this->formatDuration($course->duration_minutes),
            'rating' => (string) $course->rating,
            'price' => (int) round($course->price_cents / 100),
            'image' => $course->image ?: '527a145a-0.jpg',
        ]);
    }

    private function formatDuration(int $minutes): string
    {
        return sprintf('%dh %02dm', intdiv($minutes, 60), $minutes % 60);
    }

    public function home(): View
    {
        return view('home', ['courses' => $this->courses()->take(3)]);
    }

    public function index(Request $request): View
    {
        $courses = $this->courses();
        $search = $request->string('search')->trim()->toString();

        if ($search !== '') {
            $courses = $courses->filter(fn (array $course): bool => str_contains(strtolower($course['title'].' '.$course['description'].' '.$course['category']), strtolower($search)))->values();
        }

        foreach (['category', 'level'] as $filter) {
            if ($request->filled($filter)) {
                $courses = $courses->filter(fn (array $course): bool => strtolower($course[$filter] ?? $course['category']) === strtolower($request->string($filter)->toString()))->values();
            }
        }
        if ($request->filled('rating')) {
            $courses = $courses->filter(fn (array $course): bool => (float) $course['rating'] >= (float) $request->input('rating'))->values();
        }
        $perPage = 6;
        $page = LengthAwarePaginator::resolveCurrentPage();
        $paginatedCourses = new LengthAwarePaginator($courses->forPage($page, $perPage)->values(), $courses->count(), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]);

        return view('courses.index', ['courses' => $paginatedCourses, 'search' => $search]);
    }

    public function show(string $slug): View
    {
        $courseModel = Course::with('reviews.user')->where('slug', $slug)->firstOrFail();
        $course = $this->courses()->firstWhere('slug', $slug) ?? abort(404);

        return view('courses.show', ['course' => $course, 'reviews' => $courseModel->reviews]);
    }

    public function tutorials(Request $request): View|Response
    {
        // Featured tutorial
        $featured = Tutorial::published()->where('is_featured', true)->first()
                ?? Tutorial::published()->first();

        // Paginated list (6 per page), excluding the featured one
        $tutorials = Tutorial::published()
            ->when($featured, fn ($q) => $q->where('id', '!=', $featured->id))
            ->paginate(6);

            // AJAX request (Load More) → return only the card partial
        if ($request->ajax()) {
            return response()
                ->view('partials.tutorial-cards', compact('tutorials'))
                ->header('X-Next-Page-Url', $tutorials->nextPageUrl() ?? '');
        }

        // Category counts for sidebar
        // Category counts for sidebar
        $categoryCounts = Tutorial::published()
            ->reorder()                          // ← clears the scope's orderBy
            ->selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();

        $totalTutorials = Tutorial::published()->count();

        return view('tutorials.index', compact(
            'featured',
            'tutorials',
            'categoryCounts',
            'totalTutorials'
        ));
    }
}
