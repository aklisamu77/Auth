<?php
session_start();


$defines = array(
    'site_url' =>'https://lms.proonline.academy/Auth/',
    'user_auth'=>'You Are Not Authorize.',
    'invalid_username'=>'You Did Not Enter Correct Email Or Phone.',
    'wrong_auth'=>'Wrong Email Or Phone Or Password.'
                 
);
require($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/db.php');

$default_lang = 'en';
if (!empty($_SESSION['lang']))  $default_lang = $_SESSION['lang'];

if ($default_lang == 'en')
    require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/lang.php');
else 
    require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/lang_ar.php');

require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/functions.php');