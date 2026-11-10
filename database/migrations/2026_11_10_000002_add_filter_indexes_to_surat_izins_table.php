<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Add indexes on frequently filtered/searched columns in surat_izins.
     */
    public function up(): void
    {
        Schema::table('surat_izins', function (Blueprint $table) {
            $table->index('Status', 'idx_surat_izins_status');
            $table->index('Kpad', 'idx_surat_izins_kpad');
            $table->index('Pangkat', 'idx_surat_izins_pangkat');
            $table->index('Korps', 'idx_surat_izins_korps');
            $table->index('Nama', 'idx_surat_izins_nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_izins', function (Blueprint $table) {
            $table->dropIndex('idx_surat_izins_status');
            $table->dropIndex('idx_surat_izins_kpad');
            $table->dropIndex('idx_surat_izins_pangkat');
            $table->dropIndex('idx_surat_izins_korps');
            $table->dropIndex('idx_surat_izins_nama');
        });
    }
};
