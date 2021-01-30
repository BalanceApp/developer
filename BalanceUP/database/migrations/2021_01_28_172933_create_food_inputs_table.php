<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_inputs', function (Blueprint $table) {
            $table->id();
            $table->char('userid',255);
            $table->integer('main_meal_breakfast');
            $table->integer('main_meal_lunch');
            $table->integer('main_meal_dinner');
            $table->integer('main_dish_breakfast');
            $table->integer('main_dish_lunch');
            $table->integer('main_dish_dinner');
            $table->integer('meat');
            $table->integer('seafood');
            $table->integer('egg');
            $table->integer('bean');
            $table->integer('side_dish_breakfast');
            $table->integer('side_dish_lunch');
            $table->integer('side_dish_dinner');
            $table->integer('LCvegetable');
            $table->integer('GYvegetable');
            $table->integer('mushroom');
            $table->integer('seaweed');
            $table->integer('potato');
            $table->integer('milk_quantity');
            $table->integer('milk_frequency');
            $table->integer('fruit_quantity');
            $table->integer('fruit_frequency');
            $table->integer('sweet_quantity');
            $table->integer('sweet_frequency');
            $table->integer('salty_sweet_quantity');
            $table->integer('salty_sweet_frequency');
            $table->integer('juice_quantity');
            $table->integer('juice_frequency');
            $table->integer('fried_food');
            $table->integer('fast_food');
            $table->integer('miso_soup');
            $table->integer('noodle_soup');
            $table->integer('supply');
            $table->boolean('supply_energy');
            $table->boolean('supply_mineral');
            $table->boolean('supply_vitamin');
            $table->boolean('supply_protein');
            $table->boolean('supply_other');
            $table->boolean('unknown');
            $table->char('other_name',255)->nullable();;
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
        Schema::dropIfExists('food_inputs');
    }
}
