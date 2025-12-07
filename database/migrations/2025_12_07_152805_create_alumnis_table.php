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
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id(); 
            $table->string('nama'); 
            $table->year('tahun_lulus')->nullable(); 
            $table->string('telp', 20)->nullable(); 
            $table->enum('status_bekerja', ['bekerja', 'belum_bekerja'])->nullable(); 
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable(); 
            $table->date('tanggal_lahir')->nullable(); 
            $table->text('alamat')->nullable(); 
            $table->foreignId('id_user')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamps(); 
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
