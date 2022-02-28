<?php

use App\Model\Post;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 30; $i++) {
            $newPost = new Post();
            $newPost->title = $faker->sentence(3, true);
            $newPost->content = $faker->paragraph(5,true);
            $newPost->slug = Str::slug($newPost->title . '-' . $i);
            $newPost->save();
        }
    }
}
