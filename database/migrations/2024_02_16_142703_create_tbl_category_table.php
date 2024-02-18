<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_category', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable()->collation('utf8mb4_general_ci');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->onUpdate(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('delete_at')->nullable();
            $table->enum('is_delete', ['Y', 'N'])->nullable()->default('N')->collation('utf8mb4_general_ci');
            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_category');
    }
}
