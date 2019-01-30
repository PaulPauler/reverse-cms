<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('url')->unique();
            $table->string('module')->nullable();
            $table->boolean('show')->default(1);
            $table->integer('order')->nullable()->unsigned();
            $table->boolean('menu_id')->default(0);

            $table->nestedSet();
            $table->timestamps();
        });

        // Create languages table
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->boolean('enabled')->default(1);
        });

        // Create table for translate page
        Schema::create('pages_translates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_id');
            $table->string('name');
            $table->string('h1')->nullable();
            $table->text('content')->nullable();
            $table->string('title')->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('language_id');
            $table->timestamps();

            $table->foreign('page_id')->references('id')->on('pages')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('language_id')->references('id')->on('languages')
                ->onUpdate('cascade')->onDelete('cascade');

            // $table->primary(['language_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages_translates');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('languages');
    }
}
