<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminsRecords= [
                [
                   'id'=>1,
                   'name'=>'admin',
                   'type' =>'admin',
                    'mobile' =>'01742195643',
                    'email' =>'admin@gmail.com',
                    'password' =>'$2y$10$9/g29ZJ0cl4L6Da7DKGZE.eZaF6x1DQGJ/CUawvsKD7KBitpZFW/e',
                    'image' =>'',
                    'status' =>1,
                ],
                [
                    'id'=>2,
                    'name'=>'Arif',
                    'type' =>'subadmin',
                     'mobile' =>'01742195643',
                     'email' =>'arif@gmail.com',
                     'password' =>'$2y$10$9/g29ZJ0cl4L6Da7DKGZE.eZaF6x1DQGJ/CUawvsKD7KBitpZFW/e',
                     'image' =>'',
                     'status' =>1,
                 ],
                 [
                    'id'=>3,
                    'name'=>'Arafat',
                    'type' =>'admin',
                     'mobile' =>'01742195643',
                     'email' =>'arafat@gmail.com',
                     'password' =>'$2y$10$9/g29ZJ0cl4L6Da7DKGZE.eZaF6x1DQGJ/CUawvsKD7KBitpZFW/e',
                     'image' =>'',
                     'status' =>1,
                 ],
                 [
                    'id'=>4,
                    'name'=>'kamal',
                    'type' =>'subadmin',
                     'mobile' =>'01742195643',
                     'email' =>'kamal@gmail.com',
                     'password' =>'$2y$10$9/g29ZJ0cl4L6Da7DKGZE.eZaF6x1DQGJ/CUawvsKD7KBitpZFW/e',
                     'image' =>'',
                     'status' =>1,
                 ],
        ];
        DB::table('admins')->insert($adminsRecords);
        // foreach($adminsRecords as $key =>$record)
        // {
        //     \App\Admin::create($record);
        // }
    }
}
