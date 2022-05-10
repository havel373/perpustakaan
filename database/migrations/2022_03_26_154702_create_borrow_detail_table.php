<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peminjaman');
            $table->unsignedBigInteger('id_buku');
            $table->datetime('tanggal_pinjam');
            $table->string('denda')->nullable();
            $table->string('st');
            $table->datetime('tanggal_pengembalian')->nullable();
            $table->timestamps();
        });
        Schema::table('detail_peminjaman', function ($table) {
            $table->foreign('id_peminjaman')->references('id')->on('peminjaman')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_buku')->references('id')->on('buku')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_peminjaman');
    }
}
