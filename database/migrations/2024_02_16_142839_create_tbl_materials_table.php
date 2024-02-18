<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->default(0);
            $table->string('name', 100)->nullable()->collation('utf8mb4_general_ci');
            $table->float('qty')->nullable();
            $table->enum('is_delete', ['Y', 'N'])->default('N')->collation('utf8mb4_general_ci');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->onUpdate(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();
            $table->index('id');
            $table->unique('name', 'material_name');
            $table->foreign('category_id')->references('id')->on('tbl_category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_materials');
    }
}
