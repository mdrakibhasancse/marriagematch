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
        Schema::create('user_cv_pictures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            //submitted by
            $table->string('profile_for')->nullable();
            $table->string('cv')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('extra_pic_first')->nullable();
            $table->string('extra_pic_second')->nullable();
            $table->string('extra_pic_third')->nullable();
            $table->bigInteger('profile_user_id')->unsigned()
            ->nullable();
            $table->integer('addedby_id')->unsigned()->default(1);
            $table->integer('editedby_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_cv_pictures');
    }
};