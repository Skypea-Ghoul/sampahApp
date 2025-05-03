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
        Schema::create('bins', function (Blueprint $table) {
            $table->id();
            $table->float('weight');    // berat sampah, misal max 999999.99 kg
            $table->float('latitude');  // koordinat latitude
            $table->float('longitude'); // koordinat longitude
            $table->float('distance');       // jarak dari titik pengambilan sampah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bins');
    }
};
