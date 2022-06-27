<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("ratings", function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs("rateable"); //entidad que puede ser calificable
            $table->nullableMorphs("qualifier"); // entidad que puede ser el calificador
            $table->float("score", 2)->nullable();
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
        Schema::dropIfExists("ratings");
    }
};
