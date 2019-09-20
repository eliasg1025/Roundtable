<?php

use App\Video;
use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $video = new Video();
        $video->url = 'https://mdbootstrap.com/img/video/Lines.mp4';
        $video->user_id = 1;
        $video->save();

        $video = new Video();
        $video->url = 'https://mdbootstrap.com/img/video/animation-intro.mp4';
        $video->user_id = 1;
        $video->save();
    }
}
