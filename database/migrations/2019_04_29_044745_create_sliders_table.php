<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('caption')->nullable();
            $table->string('featured_file_name')->nullable();
            $table->string('featured_content_type')->nullable();
            $table->integer('featured_file_size')->nullable();
            $table->dateTime('start_publishing')->nullable();
            $table->dateTime('stop_publishing')->nullable();
            $table->integer('status')->nullable();
            $table->integer('position')->default(1);
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
        Schema::dropIfExists('sliders');
    }
}
