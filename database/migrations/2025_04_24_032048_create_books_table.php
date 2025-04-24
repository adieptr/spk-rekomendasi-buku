<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->enum('genre', ['fiction', 'non-fiction', 'science', 'history', 'biography', 'fantasy', 'romance']);
            $table->enum('type', ['novel', 'textbook', 'comic', 'magazine', 'encyclopedia']);
            $table->integer('sales')->default(0);
            $table->integer('ratings_count')->default(0);
            $table->float('average_rating')->default(0);
            $table->integer('reviews_count')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
};
