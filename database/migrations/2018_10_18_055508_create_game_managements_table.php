<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_management_id')->unsigned();
            $table->foreign('user_management_id')
                  ->references('id')->on('user_managements')->onDelete('cascade');

            $table->integer('level_id');
            $table->integer('no_voucher');
            $table->integer('voucher_price');
            $table->integer('no_user_point');
            $table->integer('no_of_user');
            $table->integer('remaining_user');
            $table->enum('status', ['0', '1']);
            $table->softDeletes();
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
        Schema::dropIfExists('game_managements');
    }
}
