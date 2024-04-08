<?php

use App\Models\UserFile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('bb_id')->constrained()->onDelete ('cascade');
            $table->string('url');
            $table->unsignedBigInteger('sort')->default(500);
            $table->unsignedBigInteger('size')->nullable();
            $table->string('original_name')->nullable();
            $table->string('type')->nullable();

        });
        //Storage::deleteDirectory('/public/bb');
        Storage::deleteDirectory('/public/thumbnails');
        for ($i = 1; $i < 300; $i++) {
            $count_images = count(Storage::files('public/bb'));
            $images = Storage::files('public/bb');
            $filename = $images[rand(0,($count_images-1))];
            $file_name = explode('/', $filename);
            UserFile::create(['bb_id' => $i, 'url' => $file_name[1].'/'.$file_name[2],'type' => 'jpg','size' => 123,'original_name' => $filename]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_files');
    }
};
