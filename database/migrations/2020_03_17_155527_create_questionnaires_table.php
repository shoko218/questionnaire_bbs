<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('user_id');
          $table->string('title');
          $table->string('content');
          $table->integer('number_of_responses');
          $table->integer('number_of_choices');
          $table->integer('choice0');
          $table->integer('choice1');
          $table->integer('choice2')->nullable();
          $table->integer('choice3')->nullable();
          $table->string('sentence0');
          $table->string('sentence1');
          $table->string('sentence2')->nullable();
          $table->string('sentence3')->nullable();
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
        Schema::dropIfExists('questionnaires');
    }
}
