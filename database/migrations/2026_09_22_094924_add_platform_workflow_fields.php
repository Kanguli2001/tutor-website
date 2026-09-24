<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('role')->default('student')->after('email');
            $table->boolean('notifications_enabled')->default(true)->after('role');
            $table->timestamp('deleted_at')->nullable()->after('updated_at');
        });

        Schema::table('courses', function (Blueprint $table): void {
            $table->string('status')->default('published')->after('rating');
        });

        Schema::create('lesson_progress', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
            $table->timestamp('completed_at')->nullable();
            $table->unique(['user_id', 'lesson_id']);
        });

        Schema::create('certificates', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('certificate_number')->unique();
            $table->timestamp('issued_at');
            $table->unique(['user_id', 'course_id']);
        });

        Schema::create('newsletter_subscriptions', function (Blueprint $table): void {
            $table->id();
            $table->string('email')->unique();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletter_subscriptions');
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('lesson_progress');
        Schema::table('courses', function (Blueprint $table): void {
            $table->dropColumn('status');
        });
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn(['role', 'notifications_enabled', 'deleted_at']);
        });
    }
};
