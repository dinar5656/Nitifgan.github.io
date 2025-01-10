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
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('slug');
            $table->string('brand')->nullable();
            $table->mediumText('small_description')->nullable();
            $table->longText('description')->nullable();
            $table->integer('original_price');
            $table->integer('selling_price');
            $table->integer('quantity');
            $table->tinyInteger('trending')->default('0')->comment('1=trending,0=not-trending');
            $table->tinyInteger('status')->default('0')->comment('1=hiddent,0=visible');
            $table->tinyInteger('featured')->default('0')->comment('1=featured,0=not-featured');
            $table->tinyInteger('fashions')->default('0')->comment('1=fashions,0=not-fashions');
            $table->tinyInteger('accessories')->default('0')->comment('1=accessories,0=not-accessories');
            $table->tinyInteger('appliances')->default('0')->comment('1=appliances,0=not-appliances');
            $table->string('meta_title')->nullable();
            $table->mediumText('meta_keyword')->nullable();
            $table->mediumText('meta_description')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
