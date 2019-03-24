<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnualPremiumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annual_premiums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('state_id');
            $table->unsignedSmallInteger('zipcode');
            $table->unsignedInteger('min_ann_prem');
            $table->unsignedInteger('max_ann_prem');
            $table->unsignedTinyInteger('age');
            $table->unsignedTinyInteger('gender_id');
            $table->string('name');
            $table->timestamps();

            $table->index('state_id');
            $table->index('zipcode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annual_premiums');
    }
}
