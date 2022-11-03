<?php

namespace Database\Seeders;

use App\Models\post;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::statement('SET FOREIGN_KEY_CHECKS=0;');
       Post::truncate();
       DB::statement('SET FOREIGN_KEY_CHECKS=1;');
       
    for ($i=0; $i < 30; $i++) { 
         $c =Category::inRandomOrder()->first();
         $title=Str::random(20);
         Post::create([
            'title' => $title,
            'slug' =>Str::slug($title),
            'content' => "<p> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat, vero. Minus dolorum, doloribus, pariatur praesentium est modi voluptatum dolorem sequi eius recusandae voluptate. Sit necessitatibus eius odit, aliquam fugit quibusdam! </p>",
            'category_id' =>  $c->id,
            'descripcion' => "<p> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat, vero. Minus dolorum, doloribus, pariatur praesentium est modi voluptatum dolorem sequi eius recusandae voluptate. Sit necessitatibus eius odit, aliquam fugit quibusdam! </p>",
            'posted' =>  "yes"

         ]);
    }


    }
}
