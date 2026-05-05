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
        Schema::create('main_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->string('icon')->nullable();

            // 1. Define the column (must be unsignedBigInteger to match the 'id' column)
            $table->integer('parent_id')->nullable();

            // 2. 💡 CRITICAL FIX: Explicitly add an index to the foreign key column.
            $table->index('parent_id');

            $table->integer('sort')->default(0);
            $table->integer('status')->default(1);

            $table->timestamps();

            // 3. Define the foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_menus');
    }
};
