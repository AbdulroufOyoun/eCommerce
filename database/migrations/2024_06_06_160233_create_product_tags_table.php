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
        Schema::create('product_tags', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tag_id')->constrained('tags')->cascadeOnDelete();
            //changeWhenProductAdd  states to products
            $table->foreignUuid('product_id')->constrained('states')->cascadeOnDelete();
            //
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['tag_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_tags');
    }
};
