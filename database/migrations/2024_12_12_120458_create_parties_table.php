<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->string("date");
            $table->string("image")->nullable();
            $table->string("name");
            $table->string("type");
            $table->string("address");
            $table->string("discount");
            $table->string("remark");
            $table->string("status");
            $table->string("bill_limit")->nullable();
            $table->string("duration")->nullable();
            $table->string("email")->nullable();
            $table->string("care_of")->nullable();
            $table->string("whatsapp_greeting")->nullable();
            $table->string("file")->nullable();
            $table->string("whatsapp_file")->nullable();

            $table->unsignedBigInteger("area_id")->nullable();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade'); 
            
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
        Schema::dropIfExists('parties');
    }
}
