<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191)->unique();
            $table->string('image', 191)->default('images/default.jpg');
            $table->text('content')->nullable();
            $table->text('short_desc')->nullable();
            $table->string('author');
            $table->unsignedBigInteger('cate_id');
            $table->timestamps();

            $table->foreign('cate_id')
                    ->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
