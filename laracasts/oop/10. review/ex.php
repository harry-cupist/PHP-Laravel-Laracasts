<?php

require 'src/AuthController.php';
require 'src/RegisterUser.php';

$registration = new RegisterUser;
$authController = new AuthController($registration);

$authController->register();