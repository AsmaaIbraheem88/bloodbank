<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('email', 100);
			$table->string('phone', 100);
			$table->string('subject', 60);
			$table->text('message');
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}