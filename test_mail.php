<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('./actions/send_mail.php');

$args = array(
            'from_email'    =>'auth@lms.proonline.academy',
            'from_name'     =>'Support Auth',
            'to_email'      =>'islamkhamis900@yahoo.com',
            'to_name'       =>'Islam Admin',
            'subject'       =>'Welcome Message',
            'html_body'     =>render_php('./includes/mailer/welcome.php','Ahmed Ramy'),
            'org_body'      =>'dfdfsdf',
              );

if ( send_mail($args) )
    echo 'sended';

//echo render_php('./includes/mailer/welcome.php');

