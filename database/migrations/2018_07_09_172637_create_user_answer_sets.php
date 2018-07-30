<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAnswerSets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_answer_sets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('session_id');
            $table->integer('user_id');
            $table->integer('quiz_id');
            $table->integer('question_id');
            $table->string('user_answer_set');
            $table->boolean('is_valid_answer_set');
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
        Schema::dropIfExists('user_answer_sets');
    }
}
