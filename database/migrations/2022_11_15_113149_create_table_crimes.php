<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCrimes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crimes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->text('description');
            $table->string('crime_location');
            $table->string('device_type')->nullable();
            $table->string('mac_address')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('crime_categories')->onDelete('cascade');
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
        Schema::dropIfExists('crimes');
    }
}
