<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            $table->string('publisher_name', 40);
            $table->string('publisher_image')->nullable();
            $table->text('publisher_info')->nullable();
            $table->string('publisher_link')->nullable();
            $table->string('publisher_slug')->nullable();
            $table->string('publisher_address');
            $table->string('publisher_outlet')->nullable();
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
        Schema::dropIfExists('publishers');
    }
}
