<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image', 350);
            $table->string('thumbnail', 350)->nullable()->default(null);
            $table->string('title', 500)->nullable()->default(null);
            $table->boolean('show_in_home_page')->default(false);
            $table->integer('program_type_id')->unsigned();
            $table->foreign('program_type_id')->references('id')->on('program_type')->onDelete('cascade');
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
        Schema::dropIfExists('slides');
    }
}
