<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartyMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('party_mobiles', function (Blueprint $table) {
            $table->id();
            $table->string("mobile");
            $table->string("label");
            
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
        Schema::dropIfExists('party_mobiles');
    }
}
