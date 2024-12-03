<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToRentals extends Migration
{
    public function up()
    {
        Schema::table('rentals', function (Blueprint $table) {
            // Menambahkan kolom user_id di tabel rentals dengan tipe unsignedInteger
            $table->unsignedInteger('user_id')->after('id');

            // Menambahkan foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('rentals', function (Blueprint $table) {
            // Menghapus foreign key dan kolom user_id
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
