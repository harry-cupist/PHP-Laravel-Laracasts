<?php

require 'src/RespondsToUserRegistration.php';

class AuthController implements RespondsToUserRegistration{

    // constructor injection
    protected $registration;

    public function __construct(RegisterUser $registration)
    {
        $this->registration = $registration;
    }

    // method injection
    public function register() // method injection
    {
//        $this->$registration->execute(Request()->all, $this);
        $this->registration->execute([], $this);

    }

    public function userRegisteredSuccessfully()
    {
        var_dump('create successfully. redirect somewhere');
    }

    public function userRegisteredFailed()
    {
        var_dump('create failed. redirect back');
    }
}






//
//class AuthController {
//
//    // method injection
//    public function register(RegisterUser $registration) // method injection
//    {
//        $this->$registration->execute();
//    }
//}