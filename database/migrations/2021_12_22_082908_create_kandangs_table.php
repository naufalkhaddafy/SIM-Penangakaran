<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKandangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kandangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penangkaran_id')->nullable()->constrained('penangkarans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama_kandang');
            $table->enum('kategori', ['Produktif', 'Tidak Produktif', 'Ganti Bulu']);
            $table->date('tgl_masuk_kandang');
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
        Schema::dropIfExists('kandangs');
    }
}
