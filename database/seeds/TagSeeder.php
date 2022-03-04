<?php

use Illuminate\Database\Seeder;
use App\Model\Tag;
use App\Model\Post;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'photooftheday',
            'love',
            'selfie',
            'instadaily',
            'picoftheday',
            'igers',
            'instacool',
            'bestoftheday',
            'instagood',
            'followme'
        ];
        foreach ($tags as $tag) {
            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag->slug = Post::createSlug($newTag->name,'tag');
            $newTag->save();
        }
    }
}
