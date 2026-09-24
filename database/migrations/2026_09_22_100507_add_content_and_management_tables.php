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
        Schema::table('courses', function (Blueprint $table): void {
            $table->foreignId('instructor_id')->nullable()->after('id')->constrained('users')->nullOnDelete();
            $table->string('approval_status')->default('approved')->after('status');
        });
        Schema::table('lessons', function (Blueprint $table): void {
            $table->string('content_type')->default('text')->after('title');
            $table->text('content')->nullable()->after('content_type');
            $table->string('video_url')->nullable()->after('content');
            $table->boolean('is_published')->default(true)->after('video_url');
        });
        Schema::create('categories', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });
        Schema::create('payouts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('amount_cents');
            $table->string('status')->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payouts');
        Schema::dropIfExists('categories');
        Schema::table('lessons', function (Blueprint $table): void {
            $table->dropColumn(['content_type', 'content', 'video_url', 'is_published']);
        });
        Schema::table('courses', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('instructor_id');
            $table->dropColumn('approval_status');
        });
    }
};
