<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->integer('chamado')->nullable();
            $table->integer('staff_id')->nullable();
            $table->integer('dept_id')->nullable();
            $table->integer('team_id')->nullable();
            $table->integer('aluno_id')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->integer('tipo_email')->nullable();
            $table->longText('conteudo')->nullable();
            $table->string('status_chamado')->nullable();
            $table->integer('info')->nullable();
            $table->binary('enviado')->nullable();
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
        Schema::table('emails', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('emails');
    }
}
