<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPdfToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            //
            $table->string('pdf')->nullable();
            $table->string('inside_Egypt')->nullable();
            $table->string('outside_Egypt')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            //
            $table->dropColumn('pdf');
            $table->dropColumn('inside_Egypt');
            $table->dropColumn('outside_Egypt');

        });
    }
}
