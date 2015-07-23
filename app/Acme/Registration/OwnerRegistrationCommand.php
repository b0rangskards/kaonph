<?php  namespace Acme\Registration; 

class OwnerRegistrationCommand {

    public $email;

    public $password;

	public $firstname;

	public $lastname;

	public $birthdate;

	public $gender;

	public $occupation;

    function __construct($email, $password, $firstname, $lastname, $birthdate, $gender, $occupation)
    {
        $this->email      = $email;
        $this->password   = $password;
	    $this->firstname  = $firstname;
	    $this->lastname   = $lastname;
	    $this->birthdate  = $birthdate;
	    $this->gender     = $gender;
	    $this->occupation = $occupation;
    }

} 