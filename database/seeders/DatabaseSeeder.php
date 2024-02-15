<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Course;
use App\Models\UserInterface;
use App\Models\CourseCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'phone'=>'09980730638',
            'gender'=>'male',
            'role'=>'admin',
            'position'=>'CEO',
            'password'=>Hash::make('admin1234')
         ]);

         User::create([
            'name'=>'User',
            'email'=>'user@gmail.com',
            'phone'=>'09980730636',
            'gender'=>'male',
            'role'=>'user',
            'password'=>Hash::make('user1234')
         ]);

         Course::create([
            'name'=>'Blog',
            'course_fee'=>0,
            'description'=>'Knowledge sharing.',
        ]);

        CourseCategory::create([
            'name'=>'Knowledge Sharing',
            'course_id'=>1,
        ]);

        UserInterface::create([
            'title'=>'Angle',
            'category'=>'Training Center',
            'background_color'=>null,
            'coverimage'=>null,
            'logo'=>null,
            'font_color'=>null,
            'address'=>'Yangon',
            'phone'=>'+959980730638',
            'email'=>'mr.alex4799@gmail.com',
            'map'=>'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d488797.97858163906!2d95.85189695302519!3d16.839536845157664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1949e223e196b%3A0x56fbd271f8080bb4!2sYangon!5e0!3m2!1sen!2smm!4v1706984717554!5m2!1sen!2smm'
        ]);


    }
}
