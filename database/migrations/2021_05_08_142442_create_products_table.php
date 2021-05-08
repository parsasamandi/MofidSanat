<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 35);
			$table->string('model', 35);
			$table->float('price', 10, 0);
			$table->integer('size');
			$table->text('description')->nullable();
			$table->integer('category_id')->nullable()->index('cat');
			$table->integer('subcategory_id')->nullable();
			$table->index(['subcategory_id','category_id'], 'sub_cat');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
