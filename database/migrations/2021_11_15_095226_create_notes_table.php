<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->unSignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('tag_note', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('note_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('note_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('note_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('recipient_author_note', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('author_id');
            $table->unSignedBigInteger('note_id');
            $table->unSignedBigInteger('recipient_id');
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('notes');
    }
}
