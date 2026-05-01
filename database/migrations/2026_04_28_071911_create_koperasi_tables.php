<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Tabel Kategori
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Tabel Produk
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->integer('price_general');
            $table->integer('price_member');
            $table->longText('image_url'); // longText agar bisa menampung upload/Base64
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};