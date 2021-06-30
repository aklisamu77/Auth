<?php
// add new user
require($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/defines.php');
header('Content-Type: application/json');

// add new customers / admins / super admins 
if (isset($_POST['action']) &&  $_POST['action'] =='new_category'){
    $array_of_return = array('stat'=>'error');
    $array_of_return['error'] = 'invalid-feedback';
    
    // chec for edit and edit auth
    $is_edit_user = false ;
    if (isset($_POST['edit_id'])){
        if ( get_user_role() == 'super-admin'|| get_user_role() == 'admin'  ){
                $is_edit_user = true;
                $edit_id = intval($_POST['edit_id']);
        }
        else die ;
    }
    
    
    //validate options
    if ( !isset($_POST['name']) || empty($_POST['name'])  ){
        // validate full name 
        $array_of_return['element'] = 'name';
        
    } else if (  !isset($_POST['description']) || empty($_POST['description']) ){
        // validate description
        $array_of_return['element'] = 'description';
        
    } else {
        // validate image
        //echo 'valid'; die ;
        //var_dump($_FILES); die ;
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
            $slect_name = " SELECT `ID` FROM `category` WHERE `name`='".$_POST['name']."'".$str_edit; // not secure sql 
            $res = $con->query($slect_name);
            if ($res->num_rows) {
                $array_of_return['element'] = 'name';
                $array_of_return['error'] = 'exist-feedback';
            } 
            //$array_of_return = array('stat'=>'error');
            //$array_of_return['error'] = 'invalid-feedback';
            // upload image
            else {
                $image_src = '';
                //echo 'last else ';
                if (!isset($array_of_return['element']) || $array_of_return['element']!='image')
                if (!$is_edit_user || !empty($_FILES['image']['name']) ) { // if new user or update image exist 
                    $target_dir     = $_SERVER['DOCUMENT_ROOT']."/Auth/uploads/";
                    $target_name    = rand(1,1000).'-'.rand(1,1000).'-'.rand(1,1000).'.'
                                    . pathinfo($_FILES["image"]["name"] ,PATHINFO_EXTENSION);
                    $target_file = $target_dir .$target_name; //get the file extension and append it to the new file name
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
                        $image_src= $target_name;
                } else if ($is_edit_user){
                    $slect_email = " SELECT `image` FROM `category` WHERE `ID`='".$edit_id."'"; // not secure sql 
                    $res = $con->query($slect_email);
                    if ($res->num_rows)
                         $image_src = mysqli_fetch_assoc($res)['image']; // get image from db
                        
                    //die ;
                }
                
            if ($image_src ){
                // succesfully upload file with name $target_name
                // check if current user is super admin only can regist admin and super admin
                $parent='null';
                if (isset($_POST['parent']) && intval($_POST['parent']))
                    $parent = intval($_POST['parent']);
               //echo $role; die ;
               if (!$is_edit_user){
                     $sql = "INSERT INTO `category`( `name`, `parent`, `description`,`image`)
                    VALUES ('".$_POST['name']."',".$parent.",
                    '".$_POST['description']."','".$image_src."')";
                        $msg =  "New record created successfully";
               } else {
                //echo 'Updatred'; die ;
                
                   $sql ="UPDATE `category` SET `name`='".$_POST['name']."',
                 `parent`=".$parent.",`description`='".$_POST['description']."',`image`='".$image_src."'  WHERE ID=$edit_id";
                    $msg =  "User Updated successfully";
               }

                if ($res = $con->query($sql) === TRUE) {
                        
                        $array_of_return = array('message'=>$msg,'stat'=>'success');
                } else {
                    $array_of_return['msg'] = $con->error;
                }
/*$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}*/
            }
        
        
                
            }
    }
    //var_dump($_POST);
    //var_dump($_FILES);
    }
    echo json_encode($array_of_return);
    
}


die ;
