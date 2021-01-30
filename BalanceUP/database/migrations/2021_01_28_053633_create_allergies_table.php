<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllergiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergies', function (Blueprint $table) {
            $table->id();
            $table->char('userid',255);
            $table->boolean('shrimp');
            $table->boolean('crab');
            $table->boolean('wheat');
            $table->boolean('soba');
            $table->boolean('milk');
            $table->boolean('egg');
            $table->boolean('squid');
            $table->boolean('orange');
            $table->boolean('beef');
            $table->boolean('salmon');
            $table->boolean('mackerel');
            $table->boolean('soybeans');
            $table->boolean('chicken');
            $table->boolean('banana');
            $table->boolean('peache');
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
        Schema::dropIfExists('allergies');
    }
}
