<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKpdosbimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpdosbims', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nip', 25);
            $table->string('name');
            $table->integer('kuota');
            $table->integer('jml_ajuan')->default(0);
            $table->integer('jml_terima');
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('nip')
                ->references('nip')->on('dosens')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('kpdosbims');
    }
}
