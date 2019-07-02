<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTokensTable extends Migration {

	public function up()
	{
		Schema::create('tokens', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id');
			$table->string('token',255);
			$table->enum('type', ['ios', 'android']);
		});
	}

	public function down()
	{
		Schema::drop('tokens');
	}
}