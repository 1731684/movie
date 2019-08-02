<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            // 'email' => Str::random(10).'@gmail.com',
            'email' => 'admin@admin.com',
            'phone' => '0212222222',
            'role' => 'admin',
            'address' => 'Kandy',
            'dob' => '1995-10-11',
            'gender' => 'male',
            'password' => bcrypt('admin'),
            'verify' => '1',
        ]);

        // $table->increments('id');
        //     $table->string('name')->nullable()->default('User');
        //     $table->string('email')->unique();
        //     $table->string('phone')->unique();
        //     $table->string('role')->nullable();
        //     $table->string('address')->nullable();
        //     $table->date('dob')->nullable();
        //     $table->enum('gender',['male','female','non_binary']);    
        //     $table->string('password');
        //     $table->string('verify');
    }
    
}
