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
            $table->string('name');
            $table->string('image');
            $table->string('code')->unique();
            $table->string('status');
            $table->integer('price');
            $table->string('arabic_desc');
            $table->string('english_desc');
            $table->foreignId('category_id');
            $table->foreignId('vendor_id');
            $table->foreignId('contract_id');
            $table->string('type')->default('lab');
            $table->string('manufacturer');
            $table->string('manufacturer_logo');
            $table->string('quantity');
            $table->string('brand_name');
            $table->string('product_line');
            $table->string('country_of_origin');
            $table->string('pdf');
            $table->string('url');
            $table->timestamp('deleted_at');
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
