<?php
//session_start();

if (isset($_POST) && isset($_POST['email']) && isset($_POST['password'])){
    // check 
    $username = trim($_POST['email']);
    $password = $_POST['password'];
    
    // filter
    $mobile = filter_var($username , FILTER_VALIDATE_REGEXP , ['options'=>['regexp'=>"/^[0-9]{11}$/"]]);
    if (!$mobile){
        $email = filter_var($username , FILTER_VALIDATE_EMAIL );
        if (!$email){
            header("location:../login?error=invalid_username");
        }
    }
    
    if ( ($mobile || $email) && !empty($password ) ){
        // retrive user
        
        require_once('../includes/defines.php');
        //echo 'auth'; die ;
        if (!$mobile)
            login_auth( $email , $password);
        else login_auth( $mobile , $password);
        /*global $con ; 
        $select = $mobile ? "mobile='$mobile' " : "email='$email'";
        $query = "select * from users where (  $select) AND password=md5('$password')";
        
        $res = mysqli_query($con ,$query);
        //var_dump($res) ; die ;
        if ($res->num_rows == 0){
            header("location:../login?error=wrong_auth");
        } else if ( $user = mysqli_fetch_assoc($res) ) {
            if ($user['role'] == 'admin'){
                // set cookie
                if ( !empty($_POST['remmeber']) && $_POST['remmeber'] ==1  ){
                    setcookie('user_email',$user['email'],time()+60*60*24*30,'/');
                    setcookie('user_password',md5('$password'),time()+60*60*24*30,'/');
                }
                // set session
                $_SESSION['user'] = $user['ID'];
                header("location:../profile");
            }
            else header("location:../login?error=user_auth");
        }*/
        
        mysqli_close($con);
    }
    
} else {
    echo 'Not Correct Request';
}
