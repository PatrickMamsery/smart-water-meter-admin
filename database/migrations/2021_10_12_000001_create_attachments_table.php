<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'attachments';

    /**
     * Run the migrations.
     * @table attachments
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('name');
            $table->text('original_name');
            $table->string('mime');
            $table->string('extension')->nullable()->default(null);
            $table->bigInteger('size')->default('0');
            $table->integer('sort')->default('0');
            $table->text('path');
            $table->text('description')->nullable()->default(null);
            $table->text('alt')->nullable()->default(null);
            $table->text('hash')->nullable()->default(null);
            $table->string('disk')->default('public');
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->string('group')->nullable()->default(null);
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
