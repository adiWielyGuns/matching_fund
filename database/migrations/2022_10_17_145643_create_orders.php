<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('kode');
            $table->string('name');
            $table->string('telpon');
            $table->integer('pax');
            $table->integer('table_id');
            $table->integer('reservation_id')->nullable();
            $table->integer('payment_method_id')->nullable();
            $table->string('no_ref')->nullable();
            $table->string('nama_ref')->nullable();
            $table->enum('jenis', ['langsung', 'reservasi']);
            $table->double('total_price', 20, 2);
            $table->string('created_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('orders');
    }
};
