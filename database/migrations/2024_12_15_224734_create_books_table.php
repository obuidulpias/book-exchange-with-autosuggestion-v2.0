<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained(); // Assumes `id` is the primary key of `customer` table
            $table->string('title'); // Book title
            $table->string('author'); // Author name
            $table->string('publisher')->nullable(); // Publisher
            $table->integer('publication_year')->nullable(); // Year of publication
            $table->integer('category_id'); // Genre or category
            $table->integer('sub_category_id');
            $table->text('summary')->nullable(); // Short summary/description
            $table->integer('page_count')->nullable(); // Number of pages
            $table->integer('language')->nullable(); // Language of the book
            $table->string('image')->nullable(); // Path to the image
            $table->integer('status')->default(1);
            $table->integer('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
