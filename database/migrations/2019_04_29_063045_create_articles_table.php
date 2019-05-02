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
            $table->bigIncrements('id');
            $table->string('title',150);
            $table->text('notes')->nullable();
            $table->string('logo_file_name')->nullable();
            $table->string('logo_content_type')->nullable();
            $table->integer('logo_file_size')->nullable();
            $table->dateTime('start_publishing')->nullable();
            $table->dateTime('stop_publishing')->nullable();
            $table->integer('status')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
