<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerIdReferencingColumnToQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('queries', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->after('id')->nullable();

            $table->index("customer_id", 'fk_queries_customers_idx');

            $table->foreign('customer_id', 'fk_queries_customers_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('queries', function (Blueprint $table) {
            $table->dropForeign('fk_queries_customers_idx');
            $table->dropIndex('fk_queries_customers_idx');
            $table->dropColumn('customer_id');
        });
    }
}
