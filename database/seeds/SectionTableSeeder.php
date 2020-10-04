<?php

use Illuminate\Database\Seeder;
use App\Section;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionsRecorder =[
                    [
                        'id'=>1,
                         'name' =>'men',
                         'status' =>1
                    ],
                    [
                        'id'=>2,
                         'name' =>'Women',
                         'status' =>1
                    ],
                    [
                        'id'=>3,
                         'name' =>'Kids',
                         'status' =>1
                    ],
        ];
           Section::insert($sectionsRecorder);
    }
}
