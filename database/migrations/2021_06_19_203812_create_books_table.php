<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_name');
            $table->string('book_isbn')->nullable();
            $table->string('book_image');
            $table->string('publish_year')->nullable();
            $table->text('book_slug')->nullable();
            $table->string('status')->default('pending');
            $table->integer('book_quantity');
            $table->text('book_info');

            $table->integer('user_id')->nullable();
            $table->integer('category_id')->index();
            $table->integer('publisher_id')->index();
            $table->integer('translator_id')->nullable()->index();

            $table->unsignedInteger('total_view')->default(0);
            $table->unsignedInteger('total_search')->default(0);
            $table->unsignedInteger('total_borrowed')->default(0);
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
        Schema::dropIfExists('books');
    }
}
