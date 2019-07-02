<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 100);
			$table->string('email', 100)->unique();
			$table->date('date_of_birth');
			$table->integer('blood_type_id');
			$table->integer('city_id')->unsigned();
			$table->string('pin_code', 255)->nullable();
			$table->date('last_donation_date');
			$table->string('phone', 100)->unique();
			$table->string('password');
			$table->boolean('is_active')->default(1);
			$table->string('api_token', 60)->unique()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}