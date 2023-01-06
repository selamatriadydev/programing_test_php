<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbInvoiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_invoice_item', function (Blueprint $table) {
            $table->string("itemID", 10)->primary();
            $table->string("invoiceItemID", 10)->comment("link to invoice")->references('invoiceID')->on("tb_invoice")->onDelete('cascade');
            $table->string("productItemID", 10)->comment("link to product")->references('productID')->on("tb_product")->onDelete('cascade');
            $table->decimal("quality", 18,2);
            $table->decimal("price", 18,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_invoice_item');
    }
}
