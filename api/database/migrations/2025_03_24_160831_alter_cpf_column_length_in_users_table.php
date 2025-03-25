<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove a constraint única existente
            $table->dropUnique(['cpf']);

            // Altera o tamanho da coluna
            $table->string('cpf', 11)->change();

            // Recria a constraint única com o mesmo nome
            $table->unique('cpf', 'users_cpf_unique');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove a constraint única
            $table->dropUnique('users_cpf_unique');

            // Reverte o tamanho original da coluna
            $table->string('cpf', 14)->change();

            // Recria a constraint com o tamanho original
            $table->unique('cpf', 'users_cpf_unique');
        });
    }
};
