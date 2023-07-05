<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchased_units', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('meter_id');
            $table->decimal('units', 8, 2);
            $table->tinyInteger('status')->default(0);

            $table->index(["meter_id"], 'fk_purchased_units_meters1_idx');

            $table->foreign('meter_id', 'fk_purchased_units_meters1_idx')
                ->references('id')->on('meters')
                ->onDelete('no action')
                ->onUpdate('no action');
                
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
        Schema::dropIfExists('purchased_units');
    }
}
