<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	// Create the `Videos` table
        Schema::create('videos', function($table)
        {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('user');
                $table->string('link');
                $table->text('description');
                $table->boolean('moderated')->default(false);
                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	// Delete the `Videos` table
            Schema::drop('videos');
	}

}
