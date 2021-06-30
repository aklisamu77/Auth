<?php
// connect db
require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/config.php');
global $con;
$con = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PASSWORD,DB_NAME);

if (!$con){
    echo 'Error Connect DB';
    die ;
}
