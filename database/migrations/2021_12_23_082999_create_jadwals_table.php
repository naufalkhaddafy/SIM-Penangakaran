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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produksi_id')->constrained('produksis')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tgl_akan_bertelur_start');
            $table->date('tgl_akan_bertelur_end');
            $table->date('tgl_akan_menetas_start');
            $table->date('tgl_akan_menetas_end');
            $table->string('kode_tempat_inkubator')->nullable();
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
        Schema::dropIfExists('jadwals');
    }
};
