<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeterReadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meter_readings', function (Blueprint $table) {
            $table->increments('id');
            // $table->unsignedBigInteger('customer_id')->nullable(); // redundant
            $table->unsignedInteger('meter_id')->nullable();
            $table->decimal('flow_rate', 10, 2)->nullable(); // flow rate in liters per second
            $table->decimal('total_volume', 10, 2)->nullable(); // volume in liters
            $table->date('meter_reading_date')->nullable();
            $table->enum('meter_reading_status', ['normal', 'low', 'battery', 'error'])->default('normal');
            $table->string('meter_reading_image')->nullable();
            $table->string('meter_reading_comment')->nullable();

            // $table->index(["customer_id"], 'fk_meter_readings_users1_idx');
            $table->index(["meter_id"], 'fk_meter_readings_meters1_idx');

            // $table->foreign('customer_id', 'fk_meter_readings_users1_idx')
            //     ->references('id')->on('users')
            //     ->onDelete('no action')
            //     ->onUpdate('no action');

            $table->foreign('meter_id', 'fk_meter_readings_meters1_idx')
                ->references('id')->on('meters')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meter_readings');
    }
}
