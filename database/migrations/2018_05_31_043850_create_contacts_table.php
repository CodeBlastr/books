<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->string('name')->nullable();
			$table->string('type')->nullable()->comment('vendor, customer');
			$table->string('company')->nullable();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->text('billing_address_street', 65535)->nullable();
			$table->text('billing_address_city', 65535)->nullable();
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
		Schema::drop('contacts');
	}

}
