<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortenLinksTable extends Migration
{
    public function up()
    {
        Schema::create('shorten_links', function (Blueprint $table) {
            $table->id();
            $table->string('original_link');
            $table->string('short_code')->unique();
            $table->dateTime('expired_at')->nullable();
            $table->timestamps();
        });

        Schema::create('shorten_link_views', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('link_id');

            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('referrer')->nullable();

            $table->timestamps();

            $table->foreign('link_id')->references('id')->on('shorten_links')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('shorten_link_views');
        Schema::dropIfExists('shorten_links');
    }
}
