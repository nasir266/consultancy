<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('image')->nullable();
            $table->string('item_code')->nullable();
            $table->string('size_id')->nullable();
            $table->string('barcode')->nullable();
            $table->text('description')->nullable();
            $table->integer('purchase_rate');
            $table->integer('sale_rate');
            $table->integer('party_discount');
            $table->integer('party_less');
            $table->integer('customer_less');
            $table->integer('wholesale_profit');
            $table->integer('packet_qty');
            $table->integer('pieces_in_packet');
            $table->integer('total_pieces');
            $table->string('status')->default("true");
            $table->integer('retail_sale_rate_p');
            $table->integer('retail_sale_rate');
            $table->integer('retail_less');
            $table->integer('retail_discount');
            $table->integer('retail_profit');
            $table->integer('min_level');
            $table->integer('max_level');
            $table->integer('w_sale_man_commension');
            $table->integer('r_sale_man_commension');
            
            $table->integer('define_item_id');
            $table->integer('define_size_id');

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
        Schema::dropIfExists('items');
    }
}
