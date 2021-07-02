<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateBookRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id');
            $table->integer('user_id');
            $table->integer('owner_id');
            $table->text('user_msg')->nullable();
            $table->text('owner_msg')->nullable();
            $table->string('msg_seen')->default('no');

            $table->unsignedTinyInteger('status')->default(1)->comment('1=>requset; 2=>owner_confirm, 3=>owner_reject, 4=>user_confrim, 5=>user_reject, 6=>user_return, 7=>owner_return_confirm');

            $table->dateTime('owner_confirm_time')->nullable();
            $table->dateTime('owner_reject_time')->nullable();
            $table->dateTime('user_confrim_time')->nullable();
            $table->dateTime('user_reject_time')->nullable();
            $table->dateTime('user_return_time')->nullable();
            $table->dateTime('owner_return_confirm_time')->nullable();
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
        Schema::dropIfExists('book_requests');
    }
}
