<?php

namespace App\Repositories;

use App\Models\Post;

class PostService extends Repository
{

   public function __construct()
   {
      $this->model = new Post;
   }
}