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
        Schema::create('membership_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('img_name')->nullable();
            $table->decimal('regular_price', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('discount_price', 12, 2)->default(0);
            $table->decimal('final_price', 12, 2)->default(0);
            $table->integer('duration')->default(0);
            $table->integer('daily_contact_limit')->default(0);
            $table->integer('total_contact_limit')->default(0);
            $table->integer('daily_cv_collect_limit')->default(0);
            $table->integer('total_cv_collect_limit')->default(0);
            $table->integer('daily_proposal_sent')->default(0);
            $table->integer('total_proposal_sent')->default(0);
            $table->integer('daily_matched_profile_sent')->default(0);
            $table->integer('total_matched_profile_sent')->default(0);
            $table->boolean('featured')->default(1);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('membership_packages');
    }
};