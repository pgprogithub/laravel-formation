<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $posts=[
            [
                'title'=>'Posts One ',
                'excerpt'=>'Summary of Posts One',
                'body'=>'Posts of body',
                'image_path'=>'Empty',
                'is_published'=>false,
                'min_to_read'=>2,
            ],
            [
                'title'=>'Posts Two ',
                'excerpt'=>'Summary of Posts Two',
                'body'=>'Posts of body',
                'image_path'=>'Empty',
                'is_published'=>false,
                'min_to_read'=>3,
            ]
        ];

        foreach($posts as $key => $value){
                Post::create($value);
        }
    }

}
