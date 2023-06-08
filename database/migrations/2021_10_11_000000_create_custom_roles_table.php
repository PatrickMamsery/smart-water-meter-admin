<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCustomRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45)->nullable();
            $table->nullableTimestamps();
        });

        DB::table('custom_roles')->insert([
            ["name" => "root"],
            ["name" => "admin"],
            ["name" => "client"],
            ["name" => "dawasa-manager"],
            ["name" => "guest"]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_roles');
    }
}
