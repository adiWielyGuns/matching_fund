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
        Schema::table('master_menus', function (Blueprint $table) {
            $table->dropColumn(['price_bento_mealbox', 'price_value_box', 'price_family_pack']);
            $table->double('price', 20, 2)->nullable();
            $table->double('price_after_discount', 20, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_menus', function (Blueprint $table) {
            $table->double('price_bento_mealbox', 20, 2)->nullable();
            $table->double('price_value_box', 20, 2)->nullable();
            $table->double('price_family_pack', 20, 2)->nullable();
        });
    }
};
