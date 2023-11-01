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
        Schema::create('user_education_records', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('passed_degree')->nullable();
            $table->string('passed_grade')->nullable();
            $table->string('passed_department')->nullable(); //subject
            $table->string('organization_name')->nullable();
            $table->string('organization_address')->nullable();
            $table->string('organization_type')->nullable();
            $table->date('year_from')->nullable();
            $table->date('year_to')->nullable();
            $table->date('passed_year')->nullable();
            $table->boolean('checked')->default(0); //check by admin

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_education_records');
    }
};
