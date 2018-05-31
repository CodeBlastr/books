<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->string('parent_id', 36)->nullable()->comment('belongsTo transactions');
			$table->string('account_id', 36)->comment('belongsTo accounts');
			$table->string('category_id', 36)->nullable()->comment('belongsTo accounts');
			$table->string('class_id', 36)->nullable()->comment('belongsTo accounts');
			$table->string('invoice_id', 36)->nullable()->comment('belongsTo invoices');
			$table->string('ref')->nullable();
			$table->string('type')->nullable();
			$table->string('payee')->nullable();
			$table->text('memo', 65535)->nullable();
			$table->float('payment', 10, 0)->nullable();
			$table->float('credit', 10, 0)->nullable();
			$table->boolean('status')->nullable();
			$table->string('source')->nullable();
			$table->text('data', 65535)->nullable();
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
		Schema::drop('transactions');
	}

}
