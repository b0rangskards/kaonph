<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

    protected $fillable = ['role_id', 'email', 'password'];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    /**
     * For Soft Deleting Record
     *
     * @var timestamp
     */
    protected $dates = ['deleted_at'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


    public static function register($roleId, $email, $password)
    {
        $user = new static(compact('email', 'password'));

        $user->role_id = $roleId;

        return $user;
    }

    public static function registerPublicUser($email, $password)
    {
        $publicUserId = Config::get('enums.roles.public');

        return static::register($publicUserId, $email, $password);
    }

    public static function registerOwner($email, $password)
    {
        $ownerRoleId = Config::get('enums.roles.owner');

        return static::register($ownerRoleId, $email, $password);
    }

	public function checkedInRestaurantsHistory()
	{
		return Customer::with('restaurant', 'user')
			->where('user_id', $this->id)
			->orderBy('date_visited', 'DESC')
			->get();
	}

	public function checkedInRestaurants()
	{
		return Customer::with('restaurant')
			->where('user_id', $this->id)
			->groupBy('restaurant_id')
			->orderBy('date_visited', 'DESC')
			->get();
	}

	public function isOwner()
	{
		return $this->role->name === 'owner';
	}

	public function role()
	{
		return $this->belongsTo('Role');
	}

	public function restaurants()
	{
		return $this->hasMany('Restaurant', 'owner_id', 'id');
	}

    /* Scope Queries */

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    /* Mutators */

    /**
     * Passwords must always be hashed.
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

}
