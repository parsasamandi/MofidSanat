<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subCategories', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 70)->unique('name_UNIQUE');
			$table->integer('status')->default(0);
			$table->integer('category_id')->index('c_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subCategories');
	}

}
