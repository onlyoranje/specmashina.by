<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds icon_svg column to the rubrics table for storing SVG icon codes.
 * The column was added to the create_rubrics_table migration but was not
 * present when the migration was initially run.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('rubrics', function (Blueprint $table) {
            $table->string('icon_svg')->nullable()->after('icon');
        });
    }

    public function down()
    {
        Schema::table('rubrics', function (Blueprint $table) {
            $table->dropColumn('icon_svg');
        });
    }
};