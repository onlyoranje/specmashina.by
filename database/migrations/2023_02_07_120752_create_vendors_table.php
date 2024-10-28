<?php

use App\Models\Vendor;
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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("logo")->nullable();
            $table->timestamps();
        });
        Vendor::create(['name' => 'ABG']);
        Vendor::create(['name' => 'Ammann']);
        Vendor::create(['name' => 'Atek']);
        Vendor::create(['name' => 'Atlas']);
        Vendor::create(['name' => 'Balkancar']);
        Vendor::create(['name' => 'BAW']);
        Vendor::create(['name' => 'Beifan Benchi']);
        Vendor::create(['name' => 'Bobcat']);
        Vendor::create(['name' => 'Bomag']);
        Vendor::create(['name' => 'CAMC']);
        Vendor::create(['name' => 'Case']);
        Vendor::create(['name' => 'Caterpillar']);
        Vendor::create(['name' => 'Champion']);
        Vendor::create(['name' => 'Changlin']);
        Vendor::create(['name' => 'ChengGong']);
        Vendor::create(['name' => 'Cifa']);
        Vendor::create(['name' => 'Daewoo']);
        Vendor::create(['name' => 'DAF']);
        Vendor::create(['name' => 'Demag']);
        Vendor::create(['name' => 'DongFeng']);
        Vendor::create(['name' => 'Doosan']);
        Vendor::create(['name' => 'Dressta']);
        Vendor::create(['name' => 'Dynapac']);
        Vendor::create(['name' => 'Faun']);
        Vendor::create(['name' => 'FAW']);
        Vendor::create(['name' => 'Fiat']);
        Vendor::create(['name' => 'Fiat Hitachi']);
        Vendor::create(['name' => 'Fiat Kobelco']);
        Vendor::create(['name' => 'Fiori']);
        Vendor::create(['name' => 'Ford']);
        Vendor::create(['name' => 'Foton']);
        Vendor::create(['name' => 'Freightliner']);
        Vendor::create(['name' => 'Fuchs']);
        Vendor::create(['name' => 'Furukawa']);
        Vendor::create(['name' => 'GiANT']);
        Vendor::create(['name' => 'Grove']);
        Vendor::create(['name' => 'Hamm']);
        Vendor::create(['name' => 'Hanix']);
        Vendor::create(['name' => 'Hanomag']);
        Vendor::create(['name' => 'Hanwoo']);
        Vendor::create(['name' => 'HBM-Nobas']);
        Vendor::create(['name' => 'Hidromek']);
        Vendor::create(['name' => 'Hino']);
        Vendor::create(['name' => 'Hitachi']);
        Vendor::create(['name' => 'Hongyan']);
        Vendor::create(['name' => 'Howo']);
        Vendor::create(['name' => 'Hydrema']);
        Vendor::create(['name' => 'Hyundai']);
        Vendor::create(['name' => 'International']);
        Vendor::create(['name' => 'Isuzu']);
        Vendor::create(['name' => 'Iveco']);
        Vendor::create(['name' => 'JAC']);
        Vendor::create(['name' => 'JCB']);
        Vendor::create(['name' => 'John Deere']);
        Vendor::create(['name' => 'Juejin']);
        Vendor::create(['name' => 'Kato']);
        Vendor::create(['name' => 'Kawasaki']);
        Vendor::create(['name' => 'Kenworth']);
        Vendor::create(['name' => 'Kia']);
        Vendor::create(['name' => 'Kobelco']);
        Vendor::create(['name' => 'Komatsu']);
        Vendor::create(['name' => 'Kramer']);
        Vendor::create(['name' => 'Krupp']);
        Vendor::create(['name' => 'Kubota']);
        Vendor::create(['name' => 'Liebherr']);
        Vendor::create(['name' => 'LiuGong']);
        Vendor::create(['name' => 'Locatelli']);
        Vendor::create(['name' => 'Luna']);
        Vendor::create(['name' => 'Mack']);
        Vendor::create(['name' => 'MAN']);
        Vendor::create(['name' => 'Manitou']);
        Vendor::create(['name' => 'Mercedes-Benz']);
        Vendor::create(['name' => 'Merlo']);
        Vendor::create(['name' => 'Mitsubishi']);
        Vendor::create(['name' => 'Multicar']);
        Vendor::create(['name' => 'New-Holland']);
        Vendor::create(['name' => 'Nissan']);
        Vendor::create(['name' => 'Nooteboom']);
        Vendor::create(['name' => 'O&K']);
        Vendor::create(['name' => 'Palfinger']);
        Vendor::create(['name' => 'Peterbilt']);
        Vendor::create(['name' => 'Ponsse']);
        Vendor::create(['name' => 'PowerCat']);
        Vendor::create(['name' => 'Putzmeister']);
        Vendor::create(['name' => 'Renault']);
        Vendor::create(['name' => 'Samsung']);
        Vendor::create(['name' => 'Sany']);
        Vendor::create(['name' => 'Scania']);
        Vendor::create(['name' => 'SDLG']);
        Vendor::create(['name' => 'SEM']);
        Vendor::create(['name' => 'Shaanxi']);
        Vendor::create(['name' => 'Shantui']);
        Vendor::create(['name' => 'Sinomach']);
        Vendor::create(['name' => 'Sisu']);
        Vendor::create(['name' => 'Still']);
        Vendor::create(['name' => 'Tadano-Faun']);
        Vendor::create(['name' => 'Tarsus']);
        Vendor::create(['name' => 'Tatra']);
        Vendor::create(['name' => 'TCM']);
        Vendor::create(['name' => 'Terex']);
        Vendor::create(['name' => 'Timberjack']);
        Vendor::create(['name' => 'Titan']);
        Vendor::create(['name' => 'Toyota']);
        Vendor::create(['name' => 'UDS']);
        Vendor::create(['name' => 'Unimog']);
        Vendor::create(['name' => 'Valmet']);
        Vendor::create(['name' => 'Vibromax']);
        Vendor::create(['name' => 'Vogele']);
        Vendor::create(['name' => 'Volvo']);
        Vendor::create(['name' => 'Wirtgen']);
        Vendor::create(['name' => 'XCG']);
        Vendor::create(['name' => 'XCMG']);
        Vendor::create(['name' => 'Yanmar']);
        Vendor::create(['name' => 'Zoomlion']);
        Vendor::create(['name' => 'Амкодор']);
        Vendor::create(['name' => 'БелАЗ']);
        Vendor::create(['name' => 'Беларусь']);

        Vendor::create(['name' => 'ГАЗ']);
        Vendor::create(['name' => 'ДЗ']);
        Vendor::create(['name' => 'ДУ']);
        Vendor::create(['name' => 'ЗиЛ']);
        Vendor::create(['name' => 'КамАЗ']);
        Vendor::create(['name' => 'Кировец']);
        Vendor::create(['name' => 'КрАЗ']);
        Vendor::create(['name' => 'МАЗ']);
        Vendor::create(['name' => 'МЗКТ']);
        Vendor::create(['name' => 'МТЗ']);
        Vendor::create(['name' => 'ПТЗ']);
        Vendor::create(['name' => 'Тонар']);
        Vendor::create(['name' => 'УрАЛ']);
        Vendor::create(['name' => 'Другое']);
        Vendor::create(['name' => 'JLG']);
        Vendor::create(['name' => 'Genie']);
        Vendor::create(['name' => 'Liftlux']);
        Vendor::create(['name' => 'Haulotte']);
        Vendor::create(['name' => 'Iteco']);
        Vendor::create(['name' => 'UpRight']);
        Vendor::create(['name' => 'SkyJack']);
        Vendor::create(['name' => 'ЧТЗ']);
        Vendor::create(['name' => 'Hiab']);
        Vendor::create(['name' => 'Racoon']);
        Vendor::create(['name' => 'Clarc']);
        Vendor::create(['name' => 'Venieri']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
};
