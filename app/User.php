<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait;

use Auth;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;
	use SyncableGraphNodeTrait;


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'name', 'first_name', 'last_name', 'email'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['access_token'];
//	protected $hidden = ['password', 'remember_token', 'access_token'];

	protected static $graph_node_field_aliases = [
        'id' => 'facebook_user_id',
    ];

    public function comments()
    {
        return $this->morphOne('App\Comment', 'commentable');
    }

}
