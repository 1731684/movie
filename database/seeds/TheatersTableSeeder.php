<?php

use Illuminate\Database\Seeder;

class TheatersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('theaters')->insert(['name' => 'Magestic Cinema','city_id'=>1]);
        DB::table('theaters')->insert(['name' => 'Royal Cinema','city_id'=>1]);
        DB::table('theaters')->insert(['name' => 'Kino Cinema','city_id'=>2]);
        DB::table('theaters')->insert(['name' => 'Raja Cinema','city_id'=>2]);
        DB::table('theaters')->insert(['name' => 'Kingston Theater','city_id'=>3]);
        DB::table('theaters')->insert(['name' => 'JinJung Theater','city_id'=>4]);
        DB::table('theaters')->insert(['name' => 'CoolBaby Cinema','city_id'=>1]);
        DB::table('theaters')->insert(['name' => 'TheVi Cinema','city_id'=>2]);
        DB::table('theaters')->insert(['name' => 'Ultimate Pictures','city_id'=>3]);
        DB::table('theaters')->insert(['name' => 'Astor Cinema','city_id'=>4]);
        DB::table('theaters')->insert(['name' => 'Florida Theatre','city_id'=>1]);
        DB::table('theaters')->insert(['name' => 'Palace Theater','city_id'=>1]);
    }
}
