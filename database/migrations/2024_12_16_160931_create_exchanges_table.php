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
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id'); // Foreign key column
            $table->string('ex_book_title'); // Book title
            $table->string('ex_book_author'); // Author name
            $table->string('ex_book_publisher')->nullable(); // Publisher
            $table->integer('ex_book_publication_year')->nullable(); // Year of publication
            $table->integer('ex_book_category_id'); // Genre or category
            $table->integer('ex_book_sub_category_id');
            $table->integer('status')->default(1);
            $table->softDeletes(); // Adds 'deleted_at' column for soft deletes
            $table->timestamps();

            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchanges');
    }
};
