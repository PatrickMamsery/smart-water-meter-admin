<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDawasaPersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dawasa_personnels', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('office_id')->nullable();
            $table->string('role')->nullable();

            $table->index(["user_id"], 'fk_dawasa_personnels_users1_idx');
            $table->index(["office_id"], 'fk_dawasa_personnels_dawasa_offices1_idx');

            $table->foreign('user_id', 'fk_dawasa_personnels_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('office_id', 'fk_dawasa_personnels_dawasa_offices1_idx')
                ->references('id')->on('dawasa_offices')
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
        Schema::dropIfExists('dawasa_personnels');
    }
}
