<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
//require 'vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/Auth/includes/mailer/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/Auth/includes/mailer/SMTP.php';
require $_SERVER['DOCUMENT_ROOT'].'/Auth/includes/mailer/Exception.php';


// send mail
function send_mail($args){
    
        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    
                //$mail->isSMTP();
                $mail->Host = 'lms.proonline.academy';
                $mail->SMTPAuth = true;
                $mail->Port = 587;
                $mail->Username = 'auth@lms.proonline.academy';
                $mail->Password = 'r*x%I_vble7)';
                //Recipients
                $mail->setFrom($args['from_email'], $args['from_name']);
                $mail->addAddress($args['to_email'], $args['to_name']);     //Add a recipien
            
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $args['subject'];
                $mail->Body    = $args['html_body'];
                $mail->AltBody = $args['org_body'];
            
                $mail->send();
                //echo 'sending XXX';
                return true ;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
    
}
// rendeer template file as txt 
function render_php($path,$name='Islam Khamis')
{
    ob_start();
    include($path);
    $var=ob_get_contents(); 
    ob_end_clean();
    return str_replace('{{name}}',$name,$var);
}