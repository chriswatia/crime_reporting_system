<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCrimeCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crime_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_code');
            $table->string('category_name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            //Foreign
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
        Schema::dropIfExists('crime_categories');
    }
}
