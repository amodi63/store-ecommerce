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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->decimal('price', 18 , 4, true)->default(0);
            $table->decimal('special_price', 18, 4)->nullable();
            $table->string('special_price_type')->nullable();
            $table->date('special_price_start')->nullable();
            $table->date('special_price_end')->nullable();
            $table->decimal('selling_price', 18, 4, true)->nullable();
            $table->string('sku')->nullable();
            $table->integer('qty')->nullable();
            $table->string('manage_stock')->default(1);
            $table->boolean('in_stock')->default(0);
            $table->boolean('is_active');
            $table->integer('viewed')->default(0);
            $table->softDeletes();  
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
        Schema::dropIfExists('products');
    }
};
