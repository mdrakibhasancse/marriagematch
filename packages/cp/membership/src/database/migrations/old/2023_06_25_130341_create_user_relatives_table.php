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
        Schema::create('user_relatives', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('relation_with_user')->nullable();
            $table->string('name')->nullable();
            $table->string('working_role')->nullable();
            $table->string('org_name')->nullable();
            $table->text('details')->nullable();
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
        Schema::dropIfExists('user_relatives');
    }
};
