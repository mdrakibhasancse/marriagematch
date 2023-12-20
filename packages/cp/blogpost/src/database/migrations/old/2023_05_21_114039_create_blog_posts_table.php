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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('tags')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('editor')->default(1);
            $table->string('status')->default('pending');
            $table->boolean('featured_slider')->default(1);
            $table->integer('view_count')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedBigInteger('addedby_id')->nullable();
            $table->unsignedBigInteger('editedby_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};