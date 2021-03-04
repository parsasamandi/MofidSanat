<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product', function(Blueprint $table)
		{
			$table->foreign('sc_id', 'product_ibfk_1')->references('id')->on('sub_cat')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('c_id', 'product_ibfk_2')->references('id')->on('cat')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product', function(Blueprint $table)
		{
			$table->dropForeign('product_ibfk_1');
			$table->dropForeign('product_ibfk_2');
		});
	}

}
