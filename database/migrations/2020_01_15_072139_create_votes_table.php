<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question');
            $table->json('answer_options');
            $table->integer('all_voters')->default(0);
            $table->boolean('active')->default(false);
            $table->bigInteger('type_vote_id')->unsigned()->index();
            $table->foreign('type_vote_id')->references('id')->on('type_vote');
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
        Schema::dropIfExists('votes');
    }
}
