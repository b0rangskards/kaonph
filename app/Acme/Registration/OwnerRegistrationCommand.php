<?php  namespace Acme\Registration; 

class OwnerRegistrationCommand {

    public $email;

    public $password;

    function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

} 