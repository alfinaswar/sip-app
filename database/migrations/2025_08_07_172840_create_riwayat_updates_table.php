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
        Schema::create('riwayat_updates', function (Blueprint $table) {
            $table->id();
            $table->string('IdSurat')->nullable();
            $table->string('NomorSIP', 100)->nullable();
            $table->string('Nama', 100)->nullable();
            $table->string('Pangkat', 100)->nullable();
            $table->string('Korps', 100)->nullable();
            $table->string('NRPNIP', 100)->nullable();
            $table->string('Jabatan', 100)->nullable();
            $table->string('Kesatuan', 100)->nullable();
            $table->string('Ktp', 100)->nullable();
            $table->string('Ttl', 100)->nullable();
            $table->string('Status', 100)->nullable();
            $table->string('JumlahTanggungan', 100)->nullable();
            $table->json('AnggotaKeluarga')->nullable();
            $table->string('UntukMenempati', 100)->nullable();
            $table->string('Keterangan', 100)->nullable();
            $table->string('DigunakanSebagai', 100)->nullable();
            $table->string('Kpad', 100)->nullable();
            $table->string('AlamatRumah', 100)->nullable();
            $table->string('TypeLuas', 100)->nullable();
            $table->string('Tmt', 100)->nullable();
            $table->string('TandaTangan', 100)->nullable();
            $table->string('Sebagai', 100)->nullable();
            $table->string('Foto', 100)->nullable();
            $table->longtext('Tembusan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_updates');
    }
};
