<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courseData = [
            [
               'name'=>'Bin Sachivalay',
               'short_description'=>'Et architecto provident deleniti facere repellat nobis iste. Id facere quia quae dolores dolorem tempore.',
               'full_description'=>'Full',
               'category'=>'GSSSB',
               'fees'=>'499',
               'total_seats'=>'',
               'level'=> '',
               'image'=> "http://127.0.0.1:8000/assets/img/course-1.jpg",
            ],
        ];
  
        foreach ($courseData as $key => $val) {
            Course::create($val);
        }
    }
}
