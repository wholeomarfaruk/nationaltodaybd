<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('photocard_field_maps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('photocard_template_id');
            $table->string('field_key');
            $table->string('source_type');
            $table->string('source_value');
            $table->timestamps();

            $table->foreign('photocard_template_id')
                ->references('id')
                ->on('photocard_templates')
                ->onDelete('cascade');

            $table->unique(['photocard_template_id', 'field_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photocard_field_maps');
    }
};
