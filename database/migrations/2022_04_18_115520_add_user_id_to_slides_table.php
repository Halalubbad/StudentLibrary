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
        Schema::table('slides', function (Blueprint $table) {
            //
            $table->foreignId('user_id')->after('id');
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete();

            $table->foreignId('department_id')->after('subject_name');
            $table->foreign('department_id')->on('departments')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slides', function (Blueprint $table) {
            //
            $table->dropForeign('slides_user_id_foreign');
            $table->dropColumn('user_id');

            $table->dropForeign('slides_department_id_foreign');
            $table->dropColumn('department_id');
        });
    }
};
