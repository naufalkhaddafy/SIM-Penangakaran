<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kandang_id')->constrained('kandangs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tgl_bertelur');
            $table->string('status_telur')->default('pertama');
            $table->date('tgl_masuk_inkubator')->nullable();
            $table->date('tgl_menetas')->nullable();
            $table->date('kode_ring')->nullable();
            $table->string('status_produksi')->default('inkubator');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produksis');
    }
}
