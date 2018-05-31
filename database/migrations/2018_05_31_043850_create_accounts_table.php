<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->string('title');
			$table->text('description', 65535)->nullable();
			$table->string('type')->nullable()->comment('bank, accounts receivable, other assets, fixed assets (and more)');
			$table->string('detail')->nullable()->comment('savings, checking, credit card, inventory, insurance, interest paid, and more');
			$table->float('local_balance', 10, 0)->nullable();
			$table->integer('remote_balance')->nullable();
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
		Schema::drop('accounts');
	}

}
