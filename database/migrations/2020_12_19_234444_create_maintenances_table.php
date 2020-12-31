<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->integer('head_id');
            $table->integer('flat_id');            
            $table->string('amount');//due
            $table->string('discount')->nullable();
            $table->string('method');
            $table->string('cheque_no')->nullable();
            $table->string('date');
            $table->string('type');            
            $table->string('payment');
            $table->string('month')->nullable();
            $table->longText('description')->nullable();
            $table->longText('old_slip_no')->nullable();            
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
        Schema::dropIfExists('maintenances');
    }
}
