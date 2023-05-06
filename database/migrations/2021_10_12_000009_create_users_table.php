<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable()->default(null);
            $table->unsignedInteger('role_id')->nullable()->default(1);
            $table->string('password');
            $table->rememberToken();
            $table->json('permissions')->nullable()->default(null);

            $table->unique(["email"], 'users_email_unique');
            $table->unique(["phone"], 'users_phone_unique');

            $table->index(["role_id"], 'fk_users_roles_idx');

            $table->foreign('role_id', 'fk_users_roles_idx')
                ->references('id')->on('custom_roles')
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
       Schema::dropIfExists($this->tableName);
     }
}
