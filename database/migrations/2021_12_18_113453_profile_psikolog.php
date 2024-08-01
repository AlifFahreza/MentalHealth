<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProfilePsikolog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_psikolog', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('alamat');
            $table->string('nomor');
            $table->string('pendidikan');
            $table->string('pengalaman_kerja');
            $table->string('sertifikasi');
            $table->string('password');
            $table->string('level');
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
        //
    }
}
