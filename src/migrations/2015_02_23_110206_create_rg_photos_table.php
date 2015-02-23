<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRgPhotosTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('rg_photos', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('path');
      $table->string('imageable_type');
      $table->integer('imageable_id');
      $table->string('caption');
      $table->integer('cover');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('rg_photos');
  }

}
