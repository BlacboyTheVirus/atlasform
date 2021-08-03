<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
                $table->unique('vendor_id');
            $table->string('plan');
            $table->integer('discount');
            $table->string('discountAdditional');
            $table->string('dating');
            $table->string('datingOthers');
            $table->integer('showBuy1');
            $table->integer('showBuy2');
            $table->string('incentive');
            $table->string('incentiveOthers');
            $table->string('promoFlyer');
            $table->integer('promoflyerPages');
            $table->string('brandRecognition');
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
        Schema::dropIfExists('plans');
    }
}
