<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('city_lists')->insert(['city' => 'Jaffna']);
        DB::table('city_lists')->insert(['city' => 'Colombo']);
        DB::table('city_lists')->insert(['city' => 'Kandy']);
        DB::table('city_lists')->insert(['city' => 'Mannar']);
        DB::table('city_lists')->insert(['city' => 'Kilinochi']);
        DB::table('city_lists')->insert(['city' => 'Dehiwala']);
        DB::table('city_lists')->insert(['city' => 'Moratuwa']);
        DB::table('city_lists')->insert(['city' => 'Kotte']);
        DB::table('city_lists')->insert(['city' => 'Galle']);
        DB::table('city_lists')->insert(['city' => 'Anuradhapura']);
    }
}
