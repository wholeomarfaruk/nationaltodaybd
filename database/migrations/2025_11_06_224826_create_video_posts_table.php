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
        Schema::create('video_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('excerpt')->nullable(); // Optional excerpt for the post
            $table->text('content')->nullable();
            $table->string('slug')->unique();
            $table->string('video_url')->nullable();
            $table->string('video_id')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->string('type')->nullable();// type shorts, landscape video
            $table->string('status')->default('draft'); // Status can be 'draft', 'published', or 'archived'
            $table->boolean('is_featured')->default(false); // Flag to mark featured posts
            $table->timestamps();
            $table->unsignedBigInteger('category_id')->nullable(); // Foreign key for category
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign key for user
            $table->unsignedBigInteger('author_id')->nullable(); // Foreign key for author, if applicable

            //relationships can be added here if needed
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null'); // Assuming posts are linked to categories
            $table->foreign('user_id')->references('id')->on(table: 'users')->onDelete('set null'); // Assuming posts are linked to users
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('set null'); // Assuming posts are linked to authors

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_posts');
    }
};
