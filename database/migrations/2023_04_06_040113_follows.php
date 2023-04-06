<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Follows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {

            $table->increments('id');

            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('followed_user_id');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            // 外部キー制約
            // usersのidが消えたらuser_idも消える
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // usersのidが消えたらfollowed_user_idも消える
            $table->foreign('followed_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
