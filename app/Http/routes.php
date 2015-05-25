<?php

//Route::get('/', 'WelcomeController@index');

Route::get('/', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
{
    if (Auth::check())
    {
        return redirect('dashboard');
    }
    else
    {
        // Send an array of permissions to request
        $login_url = $fb->getLoginUrl(['email']);

        // Obviously you'd do this in blade :)
        //echo '<a href="' . $login_url . '">Login with Facebook</a>';

        return view('sign.signin')->with('login_url', $login_url);
    }

    
});

Route::get('home', 'HomeController@index');

//Route::put('atualizar', 'CommentController@atualizar');
Route::resource('comments', 'CommentController');




//Route::get('articles/forward/{id}', 'ArticleController@forward');
Route::resource('articles', 'ArticleController');


Route::resource('videos', 'VideoController');


// Route::controllers([
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController',
// ]);

//Route::get('login/{provider}', 'Auth\AuthController@login');

Route::get('dashboard', 'DashboardController@index');



Route::get('/teste', function()
{
    //https://www.googleapis.com/youtube/v3/videos?id=9bZkp7q19f0&part=contentDetails&key={YOUR_API_KEY}

    $json = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?id=JRMOMjCoR58&part=snippet,contentDetails&key=' . env('YOUTUBE_KEY')));
    //$json = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?id=JRMOMjCoR58&part=snippet,contentDetails&key=' . env('YOUTUBE_KEY')));$json = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=JRMOMjCoR58&part=snippet,contentDetails&key=AIzaSyDMMfVjmsEq27tZ0fpMekywK3wkWdNx1Vg"));

    echo $json->items[0]->snippet->title;

    $json_string = json_encode($json, JSON_PRETTY_PRINT);

    echo '<img src="http://img.youtube.com/vi/WffyKIQIhjc/hqdefault.jpg">';


    echo '<pre>';
    echo $json_string ;
    echo '</pre>';
    return 'testes!' ;
});

Route::get('logout', function()
{
    Auth::logout();

    return redirect('/');
});

// Route::get('/facebook/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
//     $login_link = $fb
//             ->getRedirectLoginHelper()
//             ->getLoginUrl('https://exmaple.com/facebook/callback', ['email', 'user_events']);

//     echo '<a href="' . $login_link . '">Log in with Facebook</a>';
// });

// Generate a login URL
// Route::get('/facebook/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
// {
//     // Send an array of permissions to request
//     $login_url = $fb->getLoginUrl(['email']);

//     // Obviously you'd do this in blade :)
//     //echo '<a href="' . $login_url . '">Login with Facebook</a>';

//     return view('sign.signin');
// });

// Endpoint that is redirected to after an authentication attempt
Route::get('/facebook/callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
{
    // Obtain an access token.
    try 
    {
        $token = $fb->getAccessTokenFromRedirect();
    } 
    catch (Facebook\Exceptions\FacebookSDKException $e) 
    {
        dd($e->getMessage());
    }


    // Access token will be null if the user denied the request
    // or if someone just hit this URL outside of the OAuth flow.
    if (! $token) 
    {
        // Get the redirect helper
        $helper = $fb->getRedirectLoginHelper();

        if (! $helper->getError()) 
        {
            abort(403, 'Unauthorized action.');
        }

        // User denied the request
        dd(
            $helper->getError(),
            $helper->getErrorCode(),
            $helper->getErrorReason(),
            $helper->getErrorDescription()
        );
    }


    if (! $token->isLongLived())
    {
        // OAuth 2.0 client handler
        $oauth_client = $fb->getOAuth2Client();

        // Extend the access token.
        try 
        {
            $token = $oauth_client->getLongLivedAccessToken($token);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }


    $fb->setDefaultAccessToken($token);

    // Save for later
    Session::put('fb_user_access_token', (string) $token);

    // Get basic info on the user from Facebook.
    try 
    {
        $response = $fb->get('/me?fields=id,name,first_name,last_name,email');
        
    } 
    catch (Facebook\Exceptions\FacebookSDKException $e) 
    {
        dd($e->getMessage());
    }

    
    // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
    $facebook_user = $response->getGraphUser();

    // Create the user if it does not exist or update the existing entry.
    // This will only work if you've added the SyncableGraphNodeTrait to your User model.
    $user = App\User::createOrUpdateGraphNode($facebook_user);

    // Log the user into Laravel
    Auth::login($user);

    return redirect('/dashboard');
});




// Route::group(array('before' => 'auth'), function(){

// 	Route::get('testes', function()
// 	{
// 	    return 'testes!';
// 	});

// });



// Route::get('login/{provider}', function ($facebook = "facebook")
// {
//     // Get the provider instance
//     $provider = Socialize::with($facebook);

//     // Check, if the user authorised previously.
//     // If so, get the User instance with all data,
//     // else redirect to the provider auth screen.
//     if (Input::has('code'))
//     {
//         $user = $provider->user();

//         return var_dump($user);
//     } else {
//         return $provider->redirect();
//     }
// });

//Route::get('{provider}/authorize', 'Auth\AuthController@authorize');
//Route::get('{provider}/login', 'Auth\AuthController@login');
