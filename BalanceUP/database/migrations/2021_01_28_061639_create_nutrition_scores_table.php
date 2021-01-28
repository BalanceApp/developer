<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrition_scores', function (Blueprint $table) {
            $table->id();
            $table->char('userid',255);
            $table->float('main_meal',8,2);
            $table->float('main_dish',8,2);
            $table->float('side_dish',8,2);
            $table->float('milk',8,2);
            $table->float('fruit',8,2);
            $table->float('energy',8,2);
            $table->float('protein',8,2);
            $table->float('fat',8,2);
            $table->float('vitamin',8,2);
            $table->float('mineral',8,2);
            $table->float('fiber',8,2);
            $table->float('salt',8,2);
            $table->date('registered_date');
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
        Schema::dropIfExists('nutrition_scores');
    }
}
