<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKuotakptotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuotakptotals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tahun_code', 20);
            $table->integer('total');
            $table->integer('jml_ajuan');
            $table->timestamps();
            $table->foreign('tahun_code')
                ->references('code')->on('tahunajarans')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kuotakptotals');
    }
}
