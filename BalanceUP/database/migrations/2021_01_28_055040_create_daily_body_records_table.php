<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyBodyRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_body_records', function (Blueprint $table) {
            $table->id();
            $table->char('userid',255);
            $table->float('height',8,2);
            $table->float('weight',8,2);
            $table->float('fat',8,2);
            $table->float('mascle',8,2);
            $table->boolean('is_regular');
            $table->integer('practice_frequency');
            $table->integer('practice_time');
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
        Schema::dropIfExists('daily_body_records');
    }
}
