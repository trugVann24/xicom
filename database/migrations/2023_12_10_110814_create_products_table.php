<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->unsignedBigInteger('warranty_id')->nullable();
            $table->foreign('warranty_id')->references('id')->on('warranties');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->double('price')->nullable();
            $table->double('import_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('sold_quantity')->default(0);
            $table->text('description')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
