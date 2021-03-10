<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSubCatTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sub_cat', function(Blueprint $table)
		{
			$table->foreign('c_id', 'sub_cat_ibfk_1')->references('id')->on('cat')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sub_cat', function(Blueprint $table)
		{
			$table->dropForeign('sub_cat_ibfk_1');
		});
	}

}
