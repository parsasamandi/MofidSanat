<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCatTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sub_cat', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 55);
			$table->integer('status')->default(0);
			$table->integer('c_id')->nullable()->default(0)->index('c_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sub_cat');
	}

}
