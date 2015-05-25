<?php
use Illuminate\Database\Seeder;
use App\Video;
 
class VideoTableSeeder extends Seeder {
 
    public function run()
  	{
	   	$video = Video::create(array(
			'title' => 'Chomsky & Krauss: An Origins Project Dialogue ',
			'source_url' => 'https://www.youtube.com/watch?v=Ml1G919Bts0',			
			'status' => 1
		));		
    } 
}