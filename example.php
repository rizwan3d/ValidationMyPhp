
<?php

require_once('./vendor/autoload.php');

use Rizwan3D\ValidationMyPhp\Validation;

Validation::$DB_HOST = '127.0.0.1';
Validation::$DB_NAME = 'database';
Validation::$DB_PASSWORD = '';
Validation::$DB_USER = 'root';

$validation = new Validation();

$data = [
    'firstname' => '',
    'username' => '33158413',
    'address' => 'This is my address',
    'zipcode' => '1',
    'email' => 'jo@',
    'password' => 'test123',
    'password2' => 'test',
];



$fields = [
    'firstname' => 'required | max:255',
    'lastname' => 'required, max: 255',
    'address' => 'required | min: 10, max:255',
    'zipcode' => 'between: 5,6',
    'username' => 'required | alphanumeric | between: 3,255 | unique: users,username',
    'email' => 'required | email | unique: users,email',
    'password' => 'required | secure',
    'password2' => 'required | same:password'
];


$errors = $validation->validate($data, $fields, [
    'required' => 'The %s is required',
    'password2' => ['same'=> 'Please enter the same password again']]
);

print_r($errors);