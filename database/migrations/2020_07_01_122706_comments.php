<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_author');
            $table->unsignedBigInteger('user_recipient_comment');
            $table->string('comment');
            $table->timestamps();

            $table->foreign('user_author')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('user_recipient_comment')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
