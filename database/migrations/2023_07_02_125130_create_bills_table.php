<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable();
            $table->string('reference_number')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->decimal('amount', 13, 2)->nullable();
            $table->enum('status', ['paid', 'unpaid', 'overdue'])->default('unpaid');

            $table->index(["customer_id"], 'fk_bills_users_idx');

            $table->foreign('customer_id', 'fk_bills_users_idx')
                ->references('id')->on('users')
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
        Schema::dropIfExists('bills');
    }
}
