<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 100);
			$table->integer('donation_request_id');
			$table->text('content')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}