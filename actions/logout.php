<?php

session_start();

unset($_SESSION['user']);
setcookie('user_email',null,time(),'/');
setcookie('user_password',null,time(),'/');

header("location:../login");