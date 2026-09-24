<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
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

    public function tutorials(): View
    {
        return view('tutorials.index', ['tutorials' => [
            ['image' => 'bb0c4c4d-2.jpg', 'category' => 'UI DESIGN', 'age' => '2 days ago', 'title' => 'Building a Dark Mode Dashboard with Tailwind', 'description' => 'Learn the strategy behind semantic colors and system preference matching.', 'duration' => '15:20'],
            ['image' => 'bb0c4c4d-3.jpg', 'category' => 'REACT', 'age' => '5 days ago', 'title' => 'Understanding React Server Components', 'description' => 'The ultimate guide to how RSCs work and when to use client vs server components.', 'duration' => '12:15'],
            ['image' => 'bb0c4c4d-4.jpg', 'category' => 'TYPOGRAPHY', 'age' => '1 week ago', 'title' => 'Choosing the Perfect Sans-Serif Font Pair', 'description' => 'A deep dive into readability, x-heights, and weight distribution in digital design.', 'duration' => 'Read 8m'],
            ['image' => 'bb0c4c4d-5.jpg', 'category' => 'PROTOTYPING', 'age' => '1 week ago', 'title' => 'Advanced Micro-Interactions in Figma', 'description' => 'Master smart animate and component variants to bring your designs to life.', 'duration' => '22:10'],
        ]]);
    }
}
