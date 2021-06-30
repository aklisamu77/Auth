<?php
// add new user
require($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/defines.php');
header('Content-Type: application/json');

// add new customers / admins / super admins 
if (isset($_POST['action']) &&  $_POST['action'] =='new_product'){
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
    /* first remove albume images if edit */
    if (isset($edit_id) && isset($_POST['remove_albume_element']) && is_array($arr_remove_albumes = explode(',',$_POST['remove_albume_element'])) ){
        
        foreach($arr_remove_albumes as $remove_id){
            $sql = "Delete From `product_album`  where ID = ".intval($remove_id).";";
            $res = $con->query($sql);
        }
        
    }
    
    //validate options
    if ( !isset($_POST['name']) || empty($_POST['name'])  ){
        // validate full name 
        $array_of_return['element'] = 'name';
        
    } else if ( !isset($_POST['price']) || empty($_POST['price'])  || !is_numeric($_POST['price'])){
        // validate full name 
        $array_of_return['element'] = 'price';
        
    } else if ( !empty($_POST['sale-price']) && !is_numeric($_POST['sale-price'])  ){
        // validate full name 
        $array_of_return['element'] = 'sale-price';
        
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
            
            if (NotImageVaild($_FILES['image'])) {
                $array_of_return['element'] = 'image';
            
        } /* continue */ {
            //echo 'check '; die ;
            // all input  is valid
            $str_edit= ($is_edit_user)?' And ID !='.$edit_id :''; // exept edit user 
            // check email and phone is unique
             $slect_name = " SELECT `ID` FROM `products` WHERE `name`='".$_POST['name']."'".$str_edit; // not secure sql 
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
                
                if (!isset($array_of_return['element']) || $array_of_return['element']!='image'){
                    if (!$is_edit_user || !empty($_FILES['image']['name']) ) { // if new user or update image exist 
                    
                    if ($target_name = uploadImage($_FILES["image"]))
                        $image_src= $target_name;
                    
                    } else if ($is_edit_user){
                        $slect_email = " SELECT `image` FROM `products` WHERE `ID`='".$edit_id."'"; // not secure sql 
                        $res = $con->query($slect_email);
                        if ($res->num_rows)
                             $image_src = mysqli_fetch_assoc($res)['image']; // get image from db
                            
                        //die ;
                    }
                    
                    /* more  images */
                    // upload onl if valid images
                    $album = rearrange_files($_FILES['more-images']) ;
                    $albume_src=array();
                    if ($album)
                        foreach($album as $singleImage){
                            if (NotImageVaild($singleImage)) continue;
                            else if ($single_name = uploadImage($singleImage))
                                    $albume_src[]= $single_name;
                        }
                }
                
                
            if ($image_src ){
                // succesfully upload file with name $target_name
                // check if current user is super admin only can regist admin and super admin
                //echo $image_src; die ;
                $parent='null';
                if (isset($_POST['parent']) && intval($_POST['parent']))
                    $parent = intval($_POST['parent']);
               //echo $role; die ;
               $sql_action ='';
               if (!$is_edit_user){
                //price sale-price
                     $sql = "INSERT INTO `products`( `name`, `parent`, `description`, `image`,`price`, `sale-price`)
                     VALUES ('".$_POST['name']."',".$parent.",'".$_POST['description']."','".$image_src."'
                     ,'".$_POST['price']."','".$_POST['sale-price']."')";
                    $sql_action = 'insert';
                        $msg =  "New record created successfully";
               } else {
                //echo 'Updatred'; die ;
                
                   $sql ="UPDATE `products` SET `name`='".$_POST['name']."',
                 `parent`=".$parent.",`description`='".$_POST['description']."',`image`='".$image_src."'
                 WHERE ID=$edit_id";
                    $msg =  "User Updated successfully";
               }

                if ($res = $con->query($sql) === TRUE) {
                        // add album
                        if ($sql_action =='insert')
                            $product_id =  $con->insert_id;
                        else $product_id = $edit_id;
                    foreach($albume_src as $image_src){
                                $album_sql = ' INSERT INTO `product_album`( `product_id`, `image`) VALUES
                                        ('.$product_id.',"'.$image_src.'") ;';
                                if ( $con->query($album_sql) ){
                                } else echo $con->error;
                            }
                            //echo $album_sql2;
                            
                        
                        
                        $array_of_return = array('message'=>$msg,'stat'=>'success');
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
