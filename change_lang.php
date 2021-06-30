<?php
session_start();

if (isset ($_SESSION['lang']) && $_SESSION['lang'] =='ar')
        $_SESSION['lang'] = 'en';
        
else $_SESSION['lang']='ar';
header('location:index');