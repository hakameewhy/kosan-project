<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToReviews extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Menambahkan kolom user_id sebagai foreign key
            $table->unsignedInteger('user_id')->after('id');

            // Menambahkan foreign key constraint
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // Kasus ketika user dihapus, maka review terkait juga dihapus
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Menghapus foreign key dan kolom
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
