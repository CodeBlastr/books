<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoices', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->string('parent_id', 36)->nullable()->comment('belongsTo invoices, used in item');
			$table->string('contact_id', 36)->nullable()->comment('belongsTo contacts');
			$table->string('category_id', 36)->nullable()->comment('used in item');
			$table->string('class_id', 36)->nullable()->comment('used in item');
			$table->string('name')->nullable();
			$table->string('item')->nullable()->comment('used in item');
			$table->string('description')->nullable()->comment('used in item');
			$table->integer('quantity')->nullable()->comment('used in item');
			$table->float('rate', 10, 0)->nullable()->comment('used in item');
			$table->text('memo', 65535)->nullable()->comment('used in item');
			$table->dateTime('invoiced_at')->nullable();
			$table->dateTime('due_at')->nullable();
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
		Schema::drop('invoices');
	}

}
