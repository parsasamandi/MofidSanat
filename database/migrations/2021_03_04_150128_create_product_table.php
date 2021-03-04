<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 35);
			$table->string('model', 35);
			$table->float('price', 10, 0);
			$table->text('desc')->nullable();
			$table->integer('sc_id')->nullable();
			$table->integer('c_id')->nullable()->index('cat');
			$table->integer('status');
			$table->integer('size');
			$table->index(['sc_id','c_id'], 'sub_cat');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product');
	}

}
