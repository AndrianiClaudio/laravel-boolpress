<?php

use Illuminate\Database\Seeder;
use App\Model\Tag;
use App\Model\Post;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            // contatori
            $cont = 0;
            $contMax = 5;
            // associa tag

            $tags = [];
            while ($cont < $contMax) {
                $randomBool = rand(0, 2);
                if ($randomBool === 0) {
                    $tagId = Tag::inRandomOrder()->first()->id;
                    $tags[] = $tagId;
                }
                $cont++;
            }
            $post->tag()->sync($tags);
        }
    }
}
