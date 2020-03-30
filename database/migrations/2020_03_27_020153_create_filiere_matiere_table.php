<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiliereMatiereTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filiere_matiere', function (Blueprint $table) {
            $table->unsignedBigInteger('filiere_id');
            $table->unsignedBigInteger('matiere_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('filiere_matiere', function (Blueprint $table) {
            $table->dropForeign('filiere_matiere_filiere_id_foreign');
            $table->unsignedBigInteger('filiere_matiere_matiere_id_foreign');
        });
    }
}
