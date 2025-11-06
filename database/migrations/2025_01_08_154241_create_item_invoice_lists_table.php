<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemInvoiceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_invoice_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("item_invoice_id")->nullable();
            $table->foreign('item_invoice_id')->references('id')->on('item_invoices')->onDelete('cascade');
            $table->unsignedBigInteger("item_id")->nullable();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
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
        Schema::dropIfExists('item_invoice_lists');
    }
}
