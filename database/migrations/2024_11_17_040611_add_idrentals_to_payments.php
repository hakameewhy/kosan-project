<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdrentalsToPayments extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Menambahkan kolom idrentals di tabel payments dengan tipe unsignedInteger
            $table->unsignedInteger('idrentals')->after('idpayment');

            // Menambahkan foreign key constraint
            $table->foreign('idrentals')->references('idrentals')->on('rentals')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Menghapus foreign key dan kolom idrentals
            $table->dropForeign(['idrentals']);
            $table->dropColumn('idrentals');
        });
    }
}
