<?php
session_start();
echo 'demo<br>';

require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/classes/user.php');

//echo count( User::get_all());
//

//$user = new User(59);
//DB::Delete($user);

//var_dump($user);
require('vendor/autoload.php');

use Rakit\Validation\Validator;

$validator = new Validator;

    // make it
    $validation = $validator->make($_POST + $_FILES, [
        'name'                  => 'required',
        'email'                 => 'required|email',
        'password'              => 'required|min:6',
        'confirm_password'      => 'required|same:password',
        'avatar'                => 'required|uploaded_file:0,500K,png,jpeg',
        'skills'                => 'array',
        'skills.*.id'           => 'required|numeric',
        'skills.*.percentage'   => 'required|numeric'
    ]);
    
    
    echo 'name<br>';