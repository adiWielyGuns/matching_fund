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
        Schema::create('title_menus', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('sequence')->nullable();
            $table->string('name');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('title_menus');
    }
};
