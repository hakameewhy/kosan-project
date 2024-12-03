<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoomsidToReviews extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Menambahkan kolom roomsid di tabel reviews dengan tipe unsignedInteger
            $table->unsignedInteger('roomsid')->after('idreviews');

            // Menambahkan foreign key constraint dengan aturan on update cascade, on delete restrict
            $table->foreign('roomsid')->references('roomsid')->on('rooms')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Menghapus foreign key dan kolom roomsid
            $table->dropForeign(['roomsid']);
            $table->dropColumn('roomsid');
        });
    }
}
