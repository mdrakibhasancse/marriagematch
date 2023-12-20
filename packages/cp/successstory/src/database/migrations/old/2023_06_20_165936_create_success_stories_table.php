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
        Schema::create('success_stories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('male_user_id')->nullable();
            $table->unsignedBigInteger('female_user_id')->nullable();
            $table->string('title')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('editor')->default(1);
            $table->boolean('featured')->default(1);
            $table->string('story_type')->nullable();
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
        Schema::dropIfExists('success_stories');
    }
};