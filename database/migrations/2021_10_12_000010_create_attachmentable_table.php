<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentableTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'attachmentable';

    /**
     * Run the migrations.
     * @table attachmentable
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('attachmentable_type');
            $table->unsignedInteger('attachmentable_id');
            $table->unsignedInteger('attachment_id');

            $table->index(["attachment_id"], 'attachmentable_attachment_id_foreign');

            $table->index(["attachmentable_type", "attachmentable_id"], 'attachmentable_attachmentable_type_attachmentable_id_index');


            $table->foreign('attachment_id', 'attachmentable_attachment_id_foreign')
                ->references('id')->on('attachments')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
