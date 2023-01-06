<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_invoice', function (Blueprint $table) {
            $table->string("invoiceID", 10)->primary();
            $table->string("fromId", 10)->comment("link to company")->references('companyID')->on("tb_company")->onDelete('cascade');
            $table->string("forId", 10)->comment("link to client")->references('clientID')->on("tb_client")->onDelete('cascade');
            $table->string("status")->comment('Pending/Paid');
            $table->date("issueDate");
            $table->date("dueDate");
            $table->string("subject");
            $table->decimal("total", 18,2)->default(0);
            $table->decimal("pay", 18,2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_invoice');
    }
}
