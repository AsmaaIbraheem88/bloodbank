<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('patient_name', 255);
			$table->string('age', 50);
			$table->integer('blood_type_id');
			$table->integer('bags_num');
			$table->string('hospital_name', 100);
			$table->string('phone', 100);
			$table->integer('city_id');
			$table->decimal('latitude', 10,8)->nullable();
			$table->decimal('longitude', 10,8)->nullable();
			$table->text('notes')->nullable();
			$table->text('hospital_address');
			$table->integer('client_id');
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}