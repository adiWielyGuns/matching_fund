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
        Schema::create('privileges', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('role_id');
            $table->integer('menu_id');
            $table->boolean('view');
            $table->boolean('create');
            $table->boolean('edit');
            $table->boolean('delete');
            $table->boolean('print');
            $table->boolean('validation');
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
        Schema::dropIfExists('privileges');
    }
};
