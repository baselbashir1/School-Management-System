<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
	public function up()
	{
		Schema::table('classrooms', function (Blueprint $table) {
			$table->foreign('level_id')->references('id')->on('levels')
				->onDelete('cascade')
				->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('classrooms', function (Blueprint $table) {
			$table->dropForeign('classRooms_level_id_foreign');
		});
	}
}
