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
        Schema::create('student_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->integer('month'); // Bulan
            $table->integer('year');  // Tahun
            $table->integer('check1')->default(0); // Checklist 1
            $table->integer('check2')->default(0); // Checklist 2
            $table->integer('check3')->default(0); // Checklist 3
            $table->integer('check4')->default(0); // Checklist 4
            $table->integer('total_cash')->default(0); // Total Kas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_checklists');
    }
};
