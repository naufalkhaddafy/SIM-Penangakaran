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
            $table->enum('status_telur',['pertama','kedua']);
            $table->date('tgl_masuk_inkubator')->nullable();
            $table->date('tgl_menetas')->nullable();
            $table->string('kode_ring')->nullable();
            $table->enum('jenis_kelamin',['Jantan','Betina'])->nullable();
            $table->enum('status_produksi',['Inkubator', 'Hidup','Mati','Dijual','Terjual','Indukan']);
            $table->string('keterangan')->nullable();
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
