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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            // $table->string('img')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->bigInteger('religion_id')->unsigned()->nullable();
            $table->bigInteger('cast_id')->unsigned()->nullable();
            $table->string('skin_color')->nullable();
            $table->string('body_build')->nullable();
            $table->string('education_level')->nullable();
            $table->string('education_level_other')->nullable();
            $table->string('profession')->nullable();
            $table->string('profession_other')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('birth_country')->nullable();
            $table->string('birth_city')->nullable();
            $table->string('birth_lat')->nullable();
            $table->string('birth_lng')->nullable();
            //present country
            $table->string('present_country')->nullable();
            $table->string('present_city')->nullable();
            $table->string('present_lat')->nullable();
            $table->string('present_lng')->nullable();
            //nearest city
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('citizenship')->nullable();
            //country, present citizenship country


            $table->boolean('will_job_after_marriage')->default(1);
            $table->boolean('photo_hide')->default(0);
            $table->string('file_name')->nullable();
            $table->string('file_ext')->nullable();
            $table->string('file_for_admin_name')->nullable();
            $table->string('file_for_admin_ext')->nullable();


            $table->string('language_one')->nullable();
            $table->string('language_two')->nullable();
            $table->string('language_three')->nullable();
            $table->string('language_four')->nullable();


            $table->string('profile_pic')->nullable();
            $table->string('extra_pic_first')->nullable();
            $table->string('extra_pic_second')->nullable();
            $table->string('extra_pic_third')->nullable();
            $table->string('extra_pic_fourth')->nullable();
            $table->string('extra_pic_fifth')->nullable();
            $table->string('extra_pic_sixth')->nullable();




            $table->string('profile_created_by')->nullable();
            $table->string('profile_for')->nullable();
            $table->text('about_myself')->nullable();
            $table->decimal('yearly_income', 12, 2)->nullable();


            //family info
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('number_of_brother')->nullable();
            $table->string('how_many_brother_married')->nullable();
            $table->string('number_of_sister')->nullable();
            $table->string('how_many_sister_married')->nullable();


            $table->boolean('checked')->default(0); //check by admin
            $table->boolean('family_info_checked')->default(0); //check by admin
            $table->boolean('education_info_checked')->default(0); //check by admin
            $table->boolean('partner_info_checked')->default(0); //check by admin
            $table->boolean('review_request')->default(0); //check by admin

            $table->string('status', 8)->default('temp'); //temp, 

            $table->unsignedBigInteger('package_id')->nullable();
            $table->integer('duration')->default(0);
            $table->integer('daily_contact_limit')->default(0);
            $table->integer('total_contact_limit')->default(0);
            $table->integer('daily_cv_collect_limit')->default(0);
            $table->integer('total_cv_collect_limit')->default(0);
            $table->integer('daily_proposal_sent')->default(0);
            $table->integer('total_proposal_sent')->default(0);
            $table->integer('daily_matched_profile_sent')->default(0);
            $table->integer('total_matched_profile_sent')->default(0);

            $table->bigInteger('addedby_id')->unsigned()->default(1);
            $table->bigInteger('editedby_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
