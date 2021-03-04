<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPhoneNumberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('phone_number', function(Blueprint $table)
		{
			$table->foreign('product_id', 'phoneNumber_ibfk1')->references('id')->on('product')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('phone_number', function(Blueprint $table)
		{
			$table->dropForeign('phoneNumber_ibfk1');
		});
	}

}
