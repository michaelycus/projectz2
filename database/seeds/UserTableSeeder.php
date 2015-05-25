<?php
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {
 
    public function run()
  	{
	   	$user = User::create(array(
			'facebook_user_id' => '10206432895324665',
			'name' 			=> 'Michael Marques',
			'first_name' 	=> 'Michael',
			'last_name' 	=> 'Marques',
			'email' 		=> 'michaelycus@gmail.com',
		));

		$user = User::create(array(
			'facebook_user_id' => '100000399419035',
			'name' 			=> 'José Roberto Sousa',
			'first_name' 	=> 'José',
			'last_name' 	=> 'Roberto Sousa',
			'email' 		=> 'e',
		));

		$user = User::create(array(
			'facebook_user_id' => '100000096065425',
			'name' 			=> 'Graciela Kunrath Lima',
			'first_name' 	=> 'Graciela',
			'last_name' 	=> 'Kunrath Lima',
			'email' 		=> 'e',
		));

		$user = User::create(array(
			'facebook_user_id' => '100002775557112',
			'name' 			=> 'Juliana Thiesen Fuchs',
			'first_name' 	=> 'Juliana',
			'last_name' 	=> 'Thiesen Fuchs',
			'email' 		=> 'e',
		));
    } 
}