<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahunajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahunajarans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 20)->unique()->index();
            $table->string('tahun1', 20);
            $table->string('tahun2', 20);
            $table->string('semester', 20);
            $table->boolean('status');
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
        Schema::dropIfExists('tahunajarans');
    }
}
