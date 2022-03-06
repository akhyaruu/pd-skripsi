<?php

namespace Database\Seeders;

use App\Models\Role as ModelsRole;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      ModelsRole::insert([
         ['name'=> 'Admin'],
         ['name'=> 'Dosen'],
         ['name'=> 'Mahasiswa'],
     ]);
   }
}