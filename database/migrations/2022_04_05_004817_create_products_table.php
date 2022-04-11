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
            $table->string('id', 9)->primary();
            $table->string('ean', 13);
            $table->string('sku_provider')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('provider_full_description')->nullable();
            $table->string('provider_short_description')->nullable();
            $table->string('provider_attribute_description')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('intrastat')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('brand_supplier_name')->nullable();
            $table->string('category_name')->nullable();
            $table->string('category_name2')->nullable();
            $table->string('category_name3')->nullable();
            $table->string('category_supplier_name')->nullable();
            $table->string('category_supplier_name2')->nullable();
            $table->string('category_supplier_name3')->nullable();
            $table->string('part_number')->nullable();
            $table->string('collection')->nullable();
            $table->float('width', 8, 2)->nullable();
            $table->float('height', 8, 2)->nullable();
            $table->float('length', 8, 2)->nullable();
            $table->float('weight', 8, 3)->nullable();
            $table->float('width2', 8, 2)->nullable();
            $table->float('height2', 8, 2)->nullable();
            $table->float('length2', 8, 2)->nullable();
            $table->float('weight2', 8, 2)->nullable();
            $table->float('width_packaging', 8, 2)->nullable();
            $table->float('height_packaging', 8, 2)->nullable();
            $table->float('length_packaging', 8, 2)->nullable();
            $table->float('weight_packaging', 8, 3)->nullable();
            $table->float('width_master', 8, 2)->nullable();
            $table->float('height_master', 8, 2)->nullable();
            $table->float('length_master', 8, 2)->nullable();
            $table->float('weight_master', 8, 2)->nullable();
            $table->integer('unit_box')->nullable();
            $table->integer('unit_palet')->nullable();
            $table->integer('min_sales_unit')->nullable();
            $table->float('cbm', 10, 4)->nullable();
            $table->string('object_type_1')->nullable();
            $table->float('price_catalog', 10, 2)->nullable();
            $table->float('price_wholesale', 10, 2)->nullable();
            $table->float('price_retail', 10, 2)->nullable();
            $table->float('price', 10, 4)->nullable();
            $table->float('tax', 10, 4)->nullable();
            $table->integer('stock')->nullable();
            $table->integer('stock_catalog')->nullable();
            $table->integer('stock_to_show')->nullable();
            $table->integer('stock_available')->nullable();
            $table->integer('assortment')->nullable();
            $table->integer('vmd')->nullable();
            $table->boolean('new')->default(false);
            $table->boolean('active')->default(false);
            $table->string('source');

            // $table->string('title_attribute_0')->nullable();
            // $table->string('title_attribute_1')->nullable();
            // $table->string('title_attribute_2')->nullable();
            // $table->string('title_attribute_3')->nullable();
            // $table->string('title_attribute_4')->nullable();
            // $table->string('title_attribute_5')->nullable();
            // $table->string('translatable_title_attribute_0')->nullable();
            // $table->string('translatable_title_attribute_1')->nullable();
            // $table->string('translatable_title_attribute_2')->nullable();
            // $table->string('translatable_title_attribute_3')->nullable();
            // $table->string('translatable_title_attribute_4')->nullable();
            // $table->string('translatable_title_attribute_5')->nullable();
            // $table->string('variation_attribute_1')->nullable();
            // $table->string('variation_value_1')->nullable();
            // $table->string('variation_attribute_2')->nullable();
            // $table->string('variation_value_2')->nullable();
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
