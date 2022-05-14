<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faculities', function (Blueprint $table) {
            //
            $table->foreignId('university_id')->after('name');
            $table->foreign('university_id')->on('universities')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faculities', function (Blueprint $table) {
            //
            $table->dropForeign('faculities_university_id_foreign');
            $table->dropColumn('university_id');
        });
    }
};
