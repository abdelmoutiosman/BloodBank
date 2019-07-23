<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('phone');
			$table->string('title');
			$table->text('body');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}