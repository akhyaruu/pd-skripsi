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
         'email' => 'dosen1@gmail.com',
         'password' => bcrypt('dosen'),
      ]);
      User::create([ 
         'name' => 'Prof. Dr. Ahmad Imam Mawardi, MA',
         'role_id' => '2',
         'username' => '197008201994031001',
         'email' => 'dosen2@gmail.com',
         'password' => bcrypt('dosen'),
      ]);
      User::create([ 
         'name' => 'Zaki Munkar Azzam',
         'role_id' => '3',
         'username' => 'H06218033',
         'email' => 'mahasiswa1@gmail.com',
         'password' => bcrypt('mahasiswa'),
      ]);
      User::create([ 
         'name' => 'Alamsyah Kotohana',
         'role_id' => '3',
         'username' => 'H23167033',
         'email' => 'mahasiswa2@gmail.com',
         'password' => bcrypt('mahasiswa'),
      ]);

      
   }
}