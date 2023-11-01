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
        Schema::create('user_search_terms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->integer('min_age')->default(16); //ok
            $table->integer('max_age')->default(60); //ok
            $table->string('min_height')->nullable(); //ok
            $table->string('max_height')->nullable(); //ok
            $table->string('min_weight')->nullable(); //ok
            $table->string('max_weight')->nullable(); //ok
            $table->decimal('min_income', 12, 2)->nullable(); //ok
            $table->decimal('max_income', 12, 2)->nullable(); //ok
            $table->string('skin_color')->nullable(); //ok
            //multiple
            $table->string('body_build')->nullable(); //ok
            //multiple

            $table->string('marital_status')->nullable(); //ok
            //multiple

            $table->text('education_level')->nullable(); //ok
            //multiple


            $table->bigInteger('religion_id')->unsigned()->nullable();
            $table->bigInteger('cast_id')->unsigned()->nullable();


            $table->text('profession')->nullable();
            //multiple

            $table->string('citizen_group')->nullable();
            //multiple, citizen, non citizen, multicitizen

            $table->string('profession_group')->nullable();
            //for admin filter
            //doctor, engineer, ...

            $table->string('financial_group')->nullable();
            //for admin filter
            //vvip, vip, upper middle, middle, lower middle, lower class

            $table->string('living_group')->nullable();
            //multiple
            //parents, own family, relatives, hostel, match, abroad

            $table->string('home_group')->nullable();
            //multiple
            //village, city, capital, abroad

            $table->string('lifestyle_group')->nullable();
            //multiple
            //very conservative, conservative, culture-minded, modern, ultra modern, open-minded

            $table->string('political_group')->nullable();
            //multiple
            //political, non political

            $table->string('education_group')->nullable();
            //multiple
            //very heigher educated, heigher educated, medium educated, lower educated,

            $table->string('religious_group')->nullable();
            //multiple
            //very religious, religious, few religious, moderate, no comment

            $table->string('family_group')->nullable();


            $table->string('alcohol_group')->nullable();
            //multiple


            $table->string('smoke_group')->nullable();
            //multiple

            $table->string('disability_group')->nullable();
            //multiple

            // $table->string('gender')->nullable();
            $table->text('birth_country')->nullable(); //ok
            //multiple, 

            $table->text('present_country')->nullable(); //ok
            //multiple, 

            $table->text('citizenship')->nullable(); //ok
            //multiple

            $table->boolean('will_job_after_marriage')->default(1);

            $table->string('language')->nullable();
            //multiple



            $table->boolean('checked')->default(0);
            $table->boolean('review_request')->default(0);
            // $table->boolean('can_edit')->default(1);

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
        Schema::dropIfExists('user_search_terms');
    }
};
