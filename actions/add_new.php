<?php
// add new user
require($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/defines.php');
header('Content-Type: application/json');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// add new customers / admins / super admins 
if (isset($_POST['action']) &&  $_POST['action'] =='new_customers'){
    $array_of_return = array('stat'=>'error');
    $array_of_return['error'] = 'invalid-feedback';
    
    // chec for edit and edit auth
    $is_edit_user = false ;
    if (isset($_POST['edit_id'])){
        if ( (get_user_role() == 'super-admin') ||
           (get_user_role() == 'admin' && get_user_role($user_id) == 'user' ) ){
                $is_edit_user = true;
                $edit_id = intval($_POST['edit_id']);
        }
        else die ;
    }
    
    
    //validate options
    if ( !isset($_POST['name']) || empty($_POST['name']) || (1 === preg_match('~[0-9]~', $_POST['name'])) ){
        // validate full name 
        $array_of_return['element'] = 'name';
        
    } else if (!isset($_POST['email']) || !filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL )){
        // validate emali 
        $array_of_return['element'] = 'email';
        
    } else if (!filter_var($_POST['phone'] , FILTER_VALIDATE_REGEXP , ['options'=>['regexp'=>"/^[0-9]{11}$/"]]) || 0 ){
        // validate phone  
        $array_of_return['element'] = 'phone';
        
    }else if ( ( !isset($_POST['password']) || empty($_POST['password']) ) && !$is_edit_user){
        // validate password
        $array_of_return['element'] = 'password';
        
    } else if (
    ( !isset($_POST['c-password']) || empty($_POST['c-password']) ||$_POST['c-password'] !=$_POST['password'] )
    && !$is_edit_user){
        // confirm password validater 
        $array_of_return['element'] = 'c-password';
        
    } else if ($is_edit_user && $_POST['c-password'] !=$_POST['password']){ // if edit use and there cp assword must have passord and eq
        // confirm password validater 
        $array_of_return['element'] = 'c-password';
        
    }else {
        // validate image
        //var_dump($_FILES);
        if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name']))
            $image_info = getimagesize($_FILES['image']['tmp_name']);
        //var_dump($image_info);
        if (!$is_edit_user || ( $is_edit_user && !empty($_FILES['image']['name']) )) // if edit user iamge can be empty 
            if (!isset($_FILES['image']['name']) || empty($_FILES['image']['name']) ||
                !$image_info || ( $image_info['mime']!='image/png' &&  $image_info['mime']!='image/jpeg') ||
                $_FILES['image']['size'] > 1024 * 1024 ){
                $array_of_return['element'] = 'image';
            
        } /* continue */ {
            //echo 'check '; die ;
            // all input  is valid
            $str_edit= ($is_edit_user)?' And ID !='.$edit_id :''; // exept edit user 
            // check email and phone is unique
            $slect_email = " SELECT `ID` FROM `users` WHERE `email`='".$_POST['email']."'".$str_edit; // not secure sql 
            $res = $con->query($slect_email);
            $slect_mobile = " SELECT `ID` FROM `users` WHERE `mobile`='".$_POST['phone']."'".$str_edit; // not secure sql 
            $res2 = $con->query($slect_mobile);
            if ($res->num_rows) {
                $array_of_return['element'] = 'email';
                $array_of_return['error'] = 'exist-feedback';
            } else if ($res2->num_rows){
                $array_of_return['element'] = 'phone';
                $array_of_return['error'] = 'exist-feedback';
            }
            //$array_of_return = array('stat'=>'error');
            //$array_of_return['error'] = 'invalid-feedback';
            // upload image
            else {
                $image_src = '';
                //echo 'last else ';
                if (!$is_edit_user || !empty($_FILES['image']['name']) ) { // if new user or update image exist 
                    $target_dir     = $_SERVER['DOCUMENT_ROOT']."/Auth/uploads/";
                    $target_name    = rand(1,1000).'-'.rand(1,1000).'-'.rand(1,1000).'.'
                                    . pathinfo($_FILES["image"]["name"] ,PATHINFO_EXTENSION);
                    $target_file = $target_dir .$target_name; //get the file extension and append it to the new file name
                    //echo 'las befo last '; 
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
                         $image_src= $target_name;
                } else if ($is_edit_user){
                    $slect_email = " SELECT `image` FROM `users` WHERE `ID`='".$edit_id."'"; // not secure sql 
                    $res = $con->query($slect_email);
                    if ($res->num_rows)
                         $image_src = mysqli_fetch_assoc($res)['image']; // get image from db
                        
                    //die ;
                }
               
            if ($image_src ){
                
                // succesfully upload file with name $target_name
                // check if current user is super admin only can regist admin and super admin
                if (get_user_role() == 'super-admin')
                    $role = $_POST['role'];
                
                else 
                    $role = 'user';
               //echo $role; die ;
               $action_type = '';
               if (!$is_edit_user){
                $creator_id = get_current_user_ID()?get_current_user_ID():1;
                    $sql = "INSERT INTO `users`
                        (`email`, `name`, `password`, `mobile`, `role`, `image` ,`created_by`) VALUES
                        ('".$_POST['email']."','".$_POST['name']."',md5(".$_POST['password']."),
                        '".$_POST['phone']."','".$role."','".$image_src."',".$creator_id.")";
                        $msg =  "New record created successfully And Welcome Email sended";
                        $action_type = 'insert';
               } else {
                $password_txt = (!empty($_POST['password']) ) ? " ,password=md5(".$_POST['password'].") ":'';
                  $sql ="UPDATE `users` SET `email`='".$_POST['email']."',`name`='".$_POST['name']."',
                  `mobile`='".$_POST['phone']."',`role`='".$role."',`image`='".$image_src."' $password_txt WHERE ID=$edit_id";
                    $msg =  "User Updated successfully ";
                    
               }

                if ($res = $con->query($sql) === TRUE) {
                        //echo 'true'; die ;
                        $array_of_return = array('message'=>$msg,'stat'=>'success');
                        if ($action_type=='insert'){
                            // send eail
                            require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/actions/send_mail.php');

                            $args = array(
                                        'from_email'    =>'Support@Auth.com',
                                        'from_name'     =>'Support Auth',
                                        'to_email'      =>$_POST['email'],
                                        'to_name'       =>$_POST['name'],
                                        'subject'       =>'Welcome Message',
                                        'html_body'     => 'welcome '.$_POST['name'].' to our website',
                                        'org_body'      =>'dfdfsdf',
                                          );
                            
                            send_mail($args);
                        }
                        
                } else {
                    $array_of_return['msg'] = $con->error;
                }

            }
        
        
                
            }
    }
    
    }
    echo json_encode($array_of_return);
    
}


die ;
