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
        Schema::table('student_checklists', function (Blueprint $table) {
            $table->decimal('cash_amount', 10, 2)->default(0)->change(); // Ubah kolom menjadi angka
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_checklists', function (Blueprint $table) {
            $table->integer('cash_amount')->default(0)->change(); // Kembalikan jika rollback
        });
    }
};
