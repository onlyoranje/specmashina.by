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
        Schema::create('bbs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 50);
            $table->unsignedBigInteger('user_id')->index('bbs_user_id_foreign');
            $table->unsignedBigInteger('rubric_id')->index('bbs_rubric_id_foreign');
            $table->unsignedBigInteger('location_id')->index('bbs_location_id_foreign');
            $table->unsignedBigInteger('vendor_id')->index('bbs_vendor_id_foreign');
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->text('content')->nullable();
            $table->text('search_text')->nullable();
            $table->string('active', 1)->default('N');
            $table->unsignedBigInteger('status_bb_id')->nullable()->index('bbs_status_bb_id_foreign');
            $table->string('previus_status', 7)->nullable();
            $table->dateTime('lifted_at')->nullable();
            $table->dateTime('premium_until')->nullable();
            $table->timestamp('created_at')->nullable()->index();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bbs');
    }
};
