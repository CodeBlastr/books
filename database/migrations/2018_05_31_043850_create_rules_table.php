<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rules', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->string('parent_id', 36)->nullable();
			$table->string('account_id', 36)->nullable()->comment('belongsTo accounts');
			$table->string('payee_id', 36)->nullable();
			$table->string('category_id', 36)->nullable()->comment('belongsTo accounts');
			$table->string('class_id', 36)->nullable()->comment('belongsTo accounts');
			$table->string('name')->nullable();
			$table->boolean('money')->nullable()->comment('0 = money coming in, 1 = money going out');
			$table->boolean('collation')->nullable()->comment('0 = any, 1 = all');
			$table->string('field')->nullable()->comment('amount, bank text, description');
			$table->string('operator')->nullable()->comment('contains, exactly, excludes, equals, not_equal, greater, less');
			$table->string('type')->nullable()->comment('expense, check, transfer');
			$table->text('memo', 65535)->nullable();
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
		Schema::drop('rules');
	}

}
