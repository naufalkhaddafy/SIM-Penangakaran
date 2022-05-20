<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indukans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kandang_id')->constrained('kandangs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('produksi_id')->unique()->constrained('produksis')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['Pertama', 'Kedua']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indukans');
    }
};
