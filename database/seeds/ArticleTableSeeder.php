<?php
use Illuminate\Database\Seeder;
use App\Article;
 
class ArticleTableSeeder extends Seeder {
 
    public function run()
  	{
	   	$article = Article::create(array(
			'title' 		=> 'O “Espírito do Tempo” Personificado – Eduardo Galeano',
			'source_url' 	=> '',
			'project_url' 	=> 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1497&action=edit',
			'user_id' 		=> '4',
			'status' 		=> 0
		));

		$article = Article::create(array(
			'title' 		=> 'Estudo confirma que a humanidade está na zona de perigo existencial',
			'source_url'    => '',
			'project_url'   => 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1532&action=edit',
			'user_id'       => '1',
			'status' 		=> 1
		));

		$article = Article::create(array(
			'title' 		=> 'Automatização está substituindo terceirização',
			'source_url'    => '',
			'project_url'   => 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1090&action=edit',
			'user_id' 		=> '2',
			'status' 		=> 2
		));

		$article = Article::create(array(
			'title' 		=> 'Sobre o conceito "Zeitgeist" (Autor - Eduardo Cormanich)',
			'source_url'    => 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1457&action=edit',
			'project_url'   => 'https://docs.google.com/document/d/1aju9A1e3igf-FfWD6nTj62tdk2h-eD2ecuLag070GSY/edit?usp=sharing',
			'user_id'       => '3',
			'status'        => 3
		));
		
    } 
}