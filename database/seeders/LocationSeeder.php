<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create(['title'=>'Брестская область','parent_id'=>null,'level'=>0,'sort'=>1]);
        Location::create(['title'=>'Брест','parent_id'=>null,'level'=>1,'sort'=>1]);
        Location::create(['title'=>'Витебская область','parent_id'=>null,'level'=>0,'sort'=>2]);
        Location::create(['title'=>'Витебск','parent_id'=>null,'level'=>0,'sort'=>1]);
        Location::create(['title'=>'Гомельская область','parent_id'=>null,'level'=>0,'sort'=>3]);
        Location::create(['title'=>'Гомель','parent_id'=>null,'level'=>0,'sort'=>1]);
        Location::create(['title'=>'Гродненская область','parent_id'=>null,'level'=>0,'sort'=>4]);
        Location::create(['title'=>'Гродно','parent_id'=>null,'level'=>0,'sort'=>1]);
        Location::create(['title'=>'Минская область','parent_id'=>null,'level'=>0,'sort'=>5]);
        Location::create(['title'=>'Минск','parent_id'=>null,'level'=>0,'sort'=>1]);
        Location::create(['title'=>'Могилевская область','parent_id'=>null,'level'=>0,'sort'=>6]);
        Location::create(['title'=>'Могилев','parent_id'=>null,'level'=>0,'sort'=>1]);
    }
}
