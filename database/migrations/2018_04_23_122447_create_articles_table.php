<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 100);
            $table->string('title', 500);
            $table->text('body')->nullable()->default(null);
            $table->dateTime('published_at')->default(now());
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
/*        Schema::table('terms', function (Blueprint $table) {
            $table->dropForeign('program_type_id');
        });*/
        Schema::dropIfExists('articles');
    }
}
