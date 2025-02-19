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
        Schema::create('menu_nasi_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('nama_makanan');
            $table->decimal('harga');
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah');
            $table->string('image')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_nasi_boxes');
    }
};
