<?php
require($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/defines.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/classes/user.php');

header('Content-Type: application/json');

// remove customer 
if (isset($_POST['action']) &&  ( $_POST['action'] =='remove_user' ) ){
    
    $array_of_return = array('stat'=>'error');
    $id = intval($_POST['id']);
    
    if (get_user_role() == 'super-admin' ||
        ( get_user_role() == 'admin' && get_user_role($id) == 'user' ) ){ // super adin can remove any one
    
        $editUser = new User($id);
        if ($editUser->get_ID() == false )
            $array_of_return ['msg']= 'error Element not Exist';
        else
            DB::Delete($editUser);
        $array_of_return = array('stat'=>'success');
         
    } else $array_of_return ['msg']= 'error Role is invalid';
    
    echo json_encode($array_of_return);
}
// remove category
if (isset($_POST['action']) &&  ( $_POST['action'] =='remove_cat' ) ){
    
    $array_of_return = array('stat'=>'error');
    $id = intval($_POST['id']);
    if (get_user_role() == 'super-admin' || get_user_role() == 'admin'){ // super adin can remove any one
         $sql = "Delete From `category`  where ID = $id";

        if ($res = $con->query($sql) === TRUE)
            $array_of_return = array('stat'=>'success');
        else $array_of_return ['msg']= 'error Element not Removed';
    }
    
    echo json_encode($array_of_return);
}

// remove product
if (isset($_POST['action']) &&  ( $_POST['action'] =='remove_product' ) ){
    
    $array_of_return = array('stat'=>'error');
    $id = intval($_POST['id']);
    if (get_user_role() == 'super-admin' || get_user_role() == 'admin'){ // super adin can remove any one
         $sql = "Delete From `products`  where ID = $id";

        if ($res = $con->query($sql) === TRUE)
            $array_of_return = array('stat'=>'success');
        else $array_of_return ['msg']= 'error Element not Removed';
    }
    
    echo json_encode($array_of_return);
}