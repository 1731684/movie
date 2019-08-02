<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movie_lists')->insert([
            'movie_name' => 'Avengers Endgame',
            'language' => 'English',
            'theater_id' => '1',
            'city_id' => '1',
            'time' => '7.00AM',
            'date_from' => '2019-04-01',
            'date_to' => '2019-05-31',
            'image' => 'avengers.jpg',
        ]);
        DB::table('movie_lists')->insert([
            'movie_name' => 'Aladdin',
            'language' => 'English',
            'theater_id' => '1',
            'city_id' => '1',
            'time' => '7.00AM',
            'date_from' => '2019-04-01',
            'date_to' => '2019-05-31',
            'image' => 'aladin.jpg',
        ]);
        DB::table('movie_lists')->insert([
            'movie_name' => 'Godzilla',
            'language' => 'English',
            'theater_id' => '1',
            'city_id' => '1',
            'time' => '7.00AM',
            'date_from' => '2019-04-01',
            'date_to' => '2019-05-31',
            'image' => 'godzhilla.png',
        ]);
        DB::table('movie_lists')->insert([
            'movie_name' => 'John Wick: Chapter 3',
            'language' => 'English',
            'theater_id' => '1',
            'city_id' => '1',
            'time' => '7.00AM',
            'date_from' => '2019-04-01',
            'date_to' => '2019-05-31',
            'image' => 'JohnWick.jpg',
        ]);

        DB::table('movie_lists')->insert([
            'movie_name' => 'Avengers Endgame',
            'language' => 'English',
            'theater_id' => '2',
            'city_id' => '1',
            'time' => '7.00AM',
            'date_from' => '2019-04-01',
            'date_to' => '2019-05-31',
            'image' => 'avengers.jpg',
        ]);
        DB::table('movie_lists')->insert([
            'movie_name' => 'Aladdin',
            'language' => 'English',
            'theater_id' => '3',
            'city_id' => '1',
            'time' => '7.00AM',
            'date_from' => '2019-04-01',
            'date_to' => '2019-05-31',
            'image' => 'aladin.jpg',
        ]);
        DB::table('movie_lists')->insert([
            'movie_name' => 'Godzilla',
            'language' => 'English',
            'theater_id' => '2',
            'city_id' => '1',
            'time' => '7.00AM',
            'date_from' => '2019-04-01',
            'date_to' => '2019-05-31',
            'image' => 'godzhilla.png',
        ]);
        DB::table('movie_lists')->insert([
            'movie_name' => 'John Wick: Chapter 3',
            'language' => 'English',
            'theater_id' => '3',
            'city_id' => '1',
            'time' => '7.00AM',
            'date_from' => '2019-04-01',
            'date_to' => '2019-05-31',
            'image' => 'JohnWick.jpg',
        ]);
    }
}
