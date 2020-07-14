<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenes', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->default('Relax');
            $table->string('effect')->default('none');
            $table->string('alert')->default('none');
            $table->integer('bri')->nullable();
            $table->integer('hue')->nullable();
            $table->boolean('on')->nullable();
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
        Schema::dropIfExists('scenes');
    }
}
