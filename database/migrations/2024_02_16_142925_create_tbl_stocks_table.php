<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->default(0);
            $table->unsignedBigInteger('material_id')->default(0);
            $table->float('stock_qty')->nullable();
            $table->float('opening_balance')->nullable();
            $table->float('closing_balance')->nullable();
            $table->date('stock_date')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->onUpdate(\DB::raw('CURRENT_TIMESTAMP'));
            $table->index('category_id');
            $table->index('material_id');
            $table->foreign('category_id')->references('id')->on('tbl_category')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('tbl_materials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_stocks');
    }
}
