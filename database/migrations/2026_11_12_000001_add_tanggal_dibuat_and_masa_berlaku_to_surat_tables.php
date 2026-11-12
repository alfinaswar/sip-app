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
        Schema::table('surat_izins', function (Blueprint $table) {
            if (!Schema::hasColumn('surat_izins', 'TanggalDibuat')) {
                $table->date('TanggalDibuat')->nullable()->after('NamaTtd2');
            }
            if (!Schema::hasColumn('surat_izins', 'MasaBerlaku')) {
                $table->unsignedTinyInteger('MasaBerlaku')->nullable()->default(1)->after('TanggalDibuat');
            }
        });

        Schema::table('riwayat_updates', function (Blueprint $table) {
            if (!Schema::hasColumn('riwayat_updates', 'TanggalDibuat')) {
                $table->date('TanggalDibuat')->nullable()->after('NamaTtd2');
            }
            if (!Schema::hasColumn('riwayat_updates', 'MasaBerlaku')) {
                $table->unsignedTinyInteger('MasaBerlaku')->nullable()->default(1)->after('TanggalDibuat');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // TanggalDibuat may predate this migration on live DB; keep it to avoid data loss.
        Schema::table('surat_izins', function (Blueprint $table) {
            if (Schema::hasColumn('surat_izins', 'MasaBerlaku')) {
                $table->dropColumn('MasaBerlaku');
            }
        });

        Schema::table('riwayat_updates', function (Blueprint $table) {
            if (Schema::hasColumn('riwayat_updates', 'MasaBerlaku')) {
                $table->dropColumn('MasaBerlaku');
            }
        });
    }
};
