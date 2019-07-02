<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone', 100);
			$table->string('email', 100);
			$table->text('about_msg');
			$table->string('facebook_link', 255);
			$table->string('twitter_link', 255);
			$table->string('youtube_link', 255);
			$table->string('whatsapp_link', 255);
			$table->string('instagram_link', 255);
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}