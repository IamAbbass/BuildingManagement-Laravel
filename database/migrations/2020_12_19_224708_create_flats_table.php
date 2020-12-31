<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('block_id');
            $table->integer('floor_id');  
            $table->string('person_name')->nullable();
            $table->string('person_email')->nullable();
            $table->string('person_mobile')->nullable();
            $table->string('person_mobile2')->nullable();
            $table->string('person_cnic')->nullable();
            $table->string('person_perm_address')->nullable();
            $table->string('status')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flats');
    }
}
