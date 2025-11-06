<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_invoices', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('bill_no');
            $table->integer('vr_no');
            $table->date('party_inv_date');
            $table->integer('party_inv_no');
            $table->integer('bilty_no');
            $table->text('remarks')->nullable();
            $table->integer('pkt_qty');
            $table->integer('total_pcs');
            $table->integer('amount');
            $table->integer('less');
            $table->integer('g_amount');
            $table->integer('inv_disc_perc');
            $table->integer('disc_perc');
            $table->integer('net_amount');
            $table->integer('freight');
            $table->integer('paid_amount');
            $table->integer('total_less');
            $table->integer('total_amount');
            $table->string('payment_status')->default('unpaid');
            $table->unsignedBigInteger("godown_id")->nullable();
            $table->foreign('godown_id')->references('id')->on('godowns')->onDelete('cascade');
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
        Schema::dropIfExists('item_invoices');
    }
}
