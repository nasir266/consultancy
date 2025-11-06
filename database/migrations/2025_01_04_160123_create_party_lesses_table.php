<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartyLessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('party_lesses', function (Blueprint $table) {
            $table->id();
            $table->integer("from");
            $table->integer("to");
            $table->integer("less");
            $table->unsignedBigInteger("party_id")->nullable();
            $table->foreign('party_id')->references('id')->on('parties')->onDelete('cascade');
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
        Schema::dropIfExists('party_lesses');
    }
}
