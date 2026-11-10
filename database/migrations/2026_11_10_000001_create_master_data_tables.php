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
        Schema::create('kpads', function (Blueprint $table) {
            $table->id();
            $table->string('wilayah_kodim', 100);
            $table->string('nama_kpad', 150)->unique();
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('pangkats', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100)->unique();
            $table->string('kategori', 50)->default('Militer');
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('korps', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 30)->unique();
            $table->string('nama', 100)->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('status_penghunis', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100)->unique();
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_penghunis');
        Schema::dropIfExists('korps');
        Schema::dropIfExists('pangkats');
        Schema::dropIfExists('kpads');
    }
};
