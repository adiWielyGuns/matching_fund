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
        Schema::create('reservations', function (Blueprint $table) {
            $table->integer('id');
            $table->string('kode');
            $table->date('tanggal');
            $table->string('jam');
            $table->integer('pax');
            $table->double('nominal_transfer', 20, 2);
            $table->string('nama');
            $table->string('telpon');
            $table->string('bank');
            $table->string('no_rekening');
            $table->string('bukti_transfer');
            $table->integer('order_id');
            $table->enum('status', ['Waiting For Payment', 'Paid', 'Done', 'Canceled', 'Abandoned'])->default('Waiting For Payment');
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
        Schema::dropIfExists('reservations');
    }
};
