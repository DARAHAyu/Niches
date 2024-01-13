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
        Schema::table('purchase_orders', function (Blueprint $table) {
            // categoryカラムを削除
            $table->dropColumn('category');

            // category_idカラムを追加
            $table->unsignedInteger('category_id');
            // 外部キー制約
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            // category_idカラムを削除
            $table->dropColumn('category_id');
            
            // 外部キー制約を削除
            $table->dropForeign(['category_id']);
        });
    }
};
