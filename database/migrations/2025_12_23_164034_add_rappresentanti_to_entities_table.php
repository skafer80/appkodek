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
        Schema::table('entities', function (Blueprint $table) {
            $table->string('rappresentante_natoa')->nullable()->after('codice_fiscale');
            $table->date('rappresentante_natoil')->nullable()->after('rappresentante_natoa');
            $table->string('rappresentante_codice_fiscale')->nullable()->after('rappresentante_natoil');
            $table->string('email')->nullable()->after('telefono');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entities', function (Blueprint $table) {
            $table->dropColumn('rappresentante_natoa');
            $table->dropColumn('rappresentante_natoil');
            $table->dropColumn('rappresentante_codice_fiscale');
            $table->dropColumn('email');
        });
    }
};
