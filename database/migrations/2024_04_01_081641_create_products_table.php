<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('thumbnail');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            //automatically deleting all of the products depending on the category
            //on delete cascade so it will delete any food in that category
            $table->text('short_description');
            $table->text('long_description');
            $table->double('price'); //normal price
            $table->double('offer_price')->default(0);
            $table->integer('quantity');
            //$table->string('sku')->nullable();
            //$table->string('seo_title')->nullable();
            //$table->string('seo_description')->nullable();
            $table->boolean('show_at_home');
            $table->boolean('status');
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
