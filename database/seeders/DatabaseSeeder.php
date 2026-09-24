<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'test@example.com'], [
            'name' => 'Test User',
        ]);

        User::updateOrCreate(['email' => 'admin@example.com'], [
            'name' => 'Mawey Administrator',
            'password' => 'password',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $courses = [
            ['slug' => 'advanced-react-masterclass', 'category' => 'Web Dev', 'title' => 'Advanced React Masterclass', 'description' => 'Master hooks, context API, and performance optimization techniques used in production apps.', 'level' => 'Advanced', 'price_cents' => 8900, 'lesson_count' => 24, 'duration_minutes' => 750, 'rating' => 4.8, 'image' => '527a145a-0.jpg'],
            ['slug' => 'design-systems-with-figma', 'category' => 'Design', 'title' => 'Design Systems with Figma', 'description' => 'Learn to build scalable design systems from scratch for large enterprise-level digital products.', 'level' => 'Intermediate', 'price_cents' => 5900, 'lesson_count' => 18, 'duration_minutes' => 525, 'rating' => 5.0, 'image' => '527a145a-1.jpg'],
            ['slug' => 'full-stack-nextjs', 'category' => 'Full Stack', 'title' => 'Full-Stack Next.js 14', 'description' => 'The complete guide to building blazing fast server-rendered apps with the latest Next.js features.', 'level' => 'Advanced', 'price_cents' => 12900, 'lesson_count' => 45, 'duration_minutes' => 1335, 'rating' => 4.5, 'image' => '527a145a-2.jpg'],
            ['slug' => 'cybersecurity-fundamentals', 'category' => 'Security', 'title' => 'Cybersecurity Fundamentals', 'description' => 'Learn the basics of network security, common vulnerabilities, cryptography, and defending against threats.', 'level' => 'Beginner', 'price_cents' => 7900, 'lesson_count' => 30, 'duration_minutes' => 900, 'rating' => 4.9, 'image' => '527a145a-3.jpg'],
            ['slug' => 'swiftui-ios-17', 'category' => 'Mobile', 'title' => 'SwiftUI for iOS 17', 'description' => 'Build beautiful native iOS applications using declarative power of SwiftUI and Swift 5.9.', 'level' => 'Intermediate', 'price_cents' => 9900, 'lesson_count' => 32, 'duration_minutes' => 1100, 'rating' => 3.2, 'image' => '527a145a-4.jpg'],
            ['slug' => 'product-management-101', 'category' => 'Business', 'title' => 'Product Management 101', 'description' => 'From discovery to launch, learn the core skills required to be a successful modern product manager.', 'level' => 'Beginner', 'price_cents' => 4900, 'lesson_count' => 20, 'duration_minutes' => 610, 'rating' => 4.7, 'image' => '527a145a-5.jpg'],
        ];

        foreach ($courses as $courseData) {
            Course::updateOrCreate(['slug' => $courseData['slug']], $courseData);
        }

        $course = Course::where('slug', 'advanced-react-masterclass')->firstOrFail();
        foreach (['Foundations and first principles', 'The building blocks of a great layout'] as $position => $title) {
            $module = Module::updateOrCreate(['course_id' => $course->id, 'position' => $position + 1], ['title' => $title]);
            Lesson::updateOrCreate(['module_id' => $module->id, 'position' => 1], ['title' => 'Welcome and course overview', 'duration_minutes' => 6]);
        }
    }
}
