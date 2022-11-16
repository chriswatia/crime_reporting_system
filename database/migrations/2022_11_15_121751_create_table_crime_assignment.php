<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCrimeAssignment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crime_assignment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('officer_id');
            $table->unsignedBigInteger('crime_id');
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('officer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('crime_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crime_assignment');
    }
}
