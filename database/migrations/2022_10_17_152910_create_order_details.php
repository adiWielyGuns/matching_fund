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
        Schema::create('order_details', function (Blueprint $table) {
            $table->integer('order_id');
            $table->integer('id');
            $table->double('price', 20, 2);
            $table->integer('qty');
            $table->double('sub_total', 20, 2);
            $table->integer('master_menu_id');
            $table->string('created_by');
            $table->string('updated_by');
            $table->primary(['order_id', 'id']);
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
        Schema::dropIfExists('order_details');
    }
};
