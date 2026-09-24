<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\PublicPageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'home'])->name('home');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/tutorials', [CourseController::class, 'tutorials'])->name('tutorials.index');
Route::view('/about', 'about')->name('about');
Route::view('/verify-email', 'auth.verify-email')->name('verify-email');
Route::get('/email/verify', fn () => view('auth.verify-email'))->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'Verification email sent.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/sign-up', [AuthController::class, 'showRegister'])->name('sign-up');
Route::post('/sign-up', [AuthController::class, 'register'])->name('sign-up.store');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/pricing', [PublicPageController::class, 'pricing'])->name('pricing');
Route::get('/faq', [PublicPageController::class, 'faq'])->name('faq');
Route::get('/contact', [PublicPageController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicPageController::class, 'sendContact'])->name('contact.store');
Route::post('/newsletter', [PublicPageController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{email}', [PublicPageController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
Route::post('/newsletter/unsubscribe', [PublicPageController::class, 'confirmUnsubscribe'])->name('newsletter.unsubscribe.confirm');
Route::get('/privacy', [PublicPageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PublicPageController::class, 'terms'])->name('terms');
Route::get('/refund-policy', [PublicPageController::class, 'refund'])->name('refund');
Route::get('/certificates/{number}', [LearningController::class, 'verifyCertificate'])->name('certificates.verify');

Route::middleware('auth')->group(function (): void {
    Route::get('/dashboard', [LearningController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/notifications', [AccountController::class, 'notifications'])->name('notifications');
    Route::patch('/notifications/{notification}/read', [AccountController::class, 'markNotificationRead'])->name('notifications.read');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [AuthController::class, 'deleteAccount'])->name('profile.delete');
    Route::get('/courses/{course}/checkout', [LearningController::class, 'checkout'])->name('courses.checkout');
    Route::post('/courses/{course}/enroll', [LearningController::class, 'enroll'])->name('courses.enroll');
    Route::get('/learning/{course}', [LearningController::class, 'course'])->name('learning.course');
    Route::post('/learning/{course}/complete', [LearningController::class, 'complete'])->name('learning.complete');
    Route::post('/learning/{course}/lessons/{lesson}/complete', [LearningController::class, 'completeLesson'])->name('learning.lesson.complete');
    Route::get('/learning/{course}/certificate', [LearningController::class, 'certificate'])->name('learning.certificate');
    Route::get('/learning/{course}/certificate/download', [LearningController::class, 'downloadCertificate'])->name('learning.certificate.download');
    Route::post('/courses/{course}/reviews', [LearningController::class, 'review'])->name('courses.reviews.store');
});

Route::middleware('auth')->group(function (): void {
    Route::get('/tutor', [ManagementController::class, 'tutor'])->name('tutor.dashboard');
    Route::get('/tutor/courses/create', [ManagementController::class, 'createCourse'])->name('tutor.courses.create');
    Route::post('/tutor/courses', [ManagementController::class, 'storeCourse'])->name('tutor.courses.store');
    Route::put('/tutor/courses/{course}', [ManagementController::class, 'updateCourse'])->name('tutor.courses.update');
    Route::delete('/tutor/courses/{course}', [ManagementController::class, 'deleteCourse'])->name('tutor.courses.delete');
    Route::post('/tutor/courses/{course}/lessons', [ManagementController::class, 'storeLesson'])->name('tutor.lessons.store');
    Route::post('/tutor/courses/{course}/modules', [ManagementController::class, 'storeModule'])->name('tutor.modules.store');
    Route::put('/tutor/modules/{module}', [ManagementController::class, 'updateModule'])->name('tutor.modules.update');
    Route::delete('/tutor/modules/{module}', [ManagementController::class, 'deleteModule'])->name('tutor.modules.delete');
    Route::put('/tutor/lessons/{lesson}', [ManagementController::class, 'updateLesson'])->name('tutor.lessons.update');
    Route::delete('/tutor/lessons/{lesson}', [ManagementController::class, 'deleteLesson'])->name('tutor.lessons.delete');
    Route::get('/admin', [ManagementController::class, 'admin'])->name('admin.dashboard');
    Route::get('/admin/users', [ManagementController::class, 'users'])->name('admin.users');
    Route::put('/admin/users/{user}/role', [ManagementController::class, 'updateUserRole'])->name('admin.users.role');
    Route::delete('/admin/users/{user}', [ManagementController::class, 'deleteUser'])->name('admin.users.delete');
    Route::patch('/admin/courses/{course}/approve', [ManagementController::class, 'approveCourse'])->name('admin.courses.approve');
    Route::get('/admin/analytics', [ManagementController::class, 'analytics'])->name('admin.analytics');
    Route::get('/admin/categories', [ManagementController::class, 'categories'])->name('admin.categories');
    Route::post('/admin/categories', [ManagementController::class, 'storeCategory'])->name('admin.categories.store');
    Route::put('/admin/categories/{category}', [ManagementController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [ManagementController::class, 'deleteCategory'])->name('admin.categories.delete');
    Route::get('/tutor/analytics', [ManagementController::class, 'tutorAnalytics'])->name('tutor.analytics');
    Route::delete('/admin/reviews/{review}', [ManagementController::class, 'moderateReview'])->name('admin.reviews.delete');
    Route::patch('/admin/messages/{message}', [ManagementController::class, 'updateMessage'])->name('admin.messages.update');
});
