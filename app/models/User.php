<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

    protected $fillable = ['role_id', 'email', 'password', 'firstname', 'lastname', 'birthdate', 'gender', 'occupation'];

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


    public static function register($roleId, $email, $password, $firstname, $lastname, $birthdate, $gender, $occupation)
    {
        $user = new static(compact('email', 'password', 'email', 'password', 'firstname', 'lastname', 'birthdate', 'gender', 'occupation'));

        $user->role_id = $roleId;

        return $user;
    }

    public static function registerPublicUser($email, $password, $firstname, $lastname, $birthdate, $gender, $occupation)
    {
        $publicUserId = Config::get('enums.roles.public');

        return static::register($publicUserId, $email, $password, $firstname, $lastname, $birthdate, $gender, $occupation);
    }

    public static function registerOwner($email, $password, $firstname, $lastname, $birthdate, $gender, $occupation)
    {
        $ownerRoleId = Config::get('enums.roles.owner');

        return static::register($ownerRoleId, $email, $password, $firstname, $lastname, $birthdate, $gender, $occupation);
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

	public function closedRestaurants()
	{
		return Restaurant::onlyTrashed()
			->where('owner_id', $this->id)
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
	public function setFirstnameAttribute($value)
	{
		$this->attributes['firstname'] = strtolower($value);
	}

	public function setLastnameAttribute($value)
	{
		$this->attributes['lastname'] = strtolower($value);
	}

	public function setGenderAttribute($value)
	{
		$this->attributes['gender'] = strtolower($value);
	}

	public function setOccupationAttribute($value)
	{
		$this->attributes['occupation'] = strtolower($value);
	}

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

}
