<?php

namespace App\Controllers;
 class HomeController
 {
      public function index()
      {
          echo "Home page!";
      }
     public function store()
     {
         $method = $_POST;
         $keys = array_keys($method);
         // Вывод ключа (первого в массиве)
         dd($keys[0]);
     }

 }
