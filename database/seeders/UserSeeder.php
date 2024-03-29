<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      User::create([ 
         'name' => 'Dr. H. Jainudin, M.Si',
         'role_id' => '2',
         'username' => '196205081991031002',
         'email' => 'dsn1@gmail.com',
         'password' => bcrypt('dsn'),
      ]);
      User::create([ 
         'name' => 'Prof. Dr. Ahmad Imam Mawardi, MA',
         'role_id' => '2',
         'username' => '197008201994031001',
         'email' => 'dsn2@gmail.com',
         'password' => bcrypt('dsn'),
      ]);
      User::create([ 
         'name' => 'Zaki Munkar Azzam',
         'role_id' => '3',
         'username' => 'H06218033',
         'email' => 'mhs1@gmail.com',
         'password' => bcrypt('mhs'),
      ]);
      User::create([ 
         'name' => 'Alamsyah Kotohana',
         'role_id' => '3',
         'username' => 'H23167033',
         'email' => 'mhs2@gmail.com',
         'password' => bcrypt('mhs'),
      ]);
      User::create([ 
         'name' => 'Sakura Surya',
         'role_id' => '3',
         'username' => 'H96867033',
         'email' => 'mhs3@gmail.com',
         'password' => bcrypt('mhs'),
      ]);

      
   }
}