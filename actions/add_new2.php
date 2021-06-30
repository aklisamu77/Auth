<?php
// add new user
require($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/defines.php');
require($_SERVER['DOCUMENT_ROOT'].'/Auth/vendor/autoload.php');
require($_SERVER['DOCUMENT_ROOT'].'/Auth/classes/user.php');

use Rakit\Validation\Validator;

header('Content-Type: application/json');

// add new customers / admins / super admins 
if (isset($_POST['action']) &&  $_POST['action'] =='new_customers'){
    
    $array_of_return = array('stat'=>'error');
    $array_of_return['error'] = 'invalid-feedback';
    
    // 1 :: check for edit and edit auth
    $is_edit_user = false ;
    if (isset($_POST['edit_id'])){
        if ( (get_user_role() == 'super-admin') ||
           (get_user_role() == 'admin' && get_user_role($user_id) == 'user' ) ){
                $is_edit_user = true;
                $edit_id = intval($_POST['edit_id']);
        }
        else die ;
    }
    // 2 :: validate text anf files
    $validator = new Validator;

    // validation rules
    $str_of_c= (!empty($_POST['password']))? 'required|':'' ;
    $arr_of_rules = array(
        'name'      => 'required|regex:/^[A-Za-z ]+$/',
        'email'     => 'required|email',
        'phone'     => 'required|min:11|regex:/^[0-9]{11}$/',
        'password'  =>(!$is_edit_user)?'required|min:6':'min:6',
        'c-password'=>(!$is_edit_user)?'required|same:password':$str_of_c.'same:password',
        'image'     =>(!$is_edit_user)?'required|uploaded_file:0,2M,png,jpeg':'uploaded_file:0,2M,png,jpeg',
    );
    
    $validation = $validator->make($_POST + $_FILES, $arr_of_rules);

    // then validate
    $validation->validate();
    if ($validation->fails()) {
        // handling errors
        $errors = $validation->errors();
        $array_of_return['validate']  = $errors->firstOfAll();
    
    } else {
    // validation passes
    
    // 3 :: check email and phone not exists
    require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/config.php');
    $pdo1 = new PDO(Dns, Dbuser, Dbpassword);
    // stmt
    $str_edit= ($is_edit_user)?' And ID !='.$edit_id :'';
    // email
        if ( $row_email = User::checkExist('email',$_POST['email'],$str_edit) )
            $array_of_return['validate']['email'] = 'Email is already exist';
    // phone
        if ( $row_mobile = User::checkExist('mobile',$_POST['phone'],$str_edit) )
            $array_of_return['validate']['phone'] = 'Phone is already exist';
    
    if (!$row_mobile && !$row_email){
        // 4 :: upload image
        $images_src = uploadImage($_FILES['image']);
    
    // set role
    $role = (get_user_role() == 'super-admin' && !empty($_POST['role'] ) ) ? $_POST['role'] :'user' ;
    $action_type = '';
    $data = array( // 
            'email'     =>$_POST['email'],
            'name'      =>$_POST['name'],
            //'password'  =>md5($_POST['password']),
            'mobile'    =>$_POST['phone'],
            'role'      =>$role,
            'image'     =>$images_src,
            
            );
    if (isset($_POST['password'])) $data['password'] = md5($_POST['password']);
    
    
    if (!$is_edit_user){
        // new user
        $data['created_by'] = get_current_user_ID()?get_current_user_ID():1;
        $new_user = new User();
        $insert = DB::Insert($new_user,$data);
        $msg = 'New record created successfully And Welcome Email sended';
        if ($insert){ // success
            $array_of_return = array('message'=>$msg,'stat'=>'success');
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
        } else $array_of_return['validate']['email'] = 'Error on insert';
        // end insrt 
        } else {
            $edit_user = new user($edit_id);
            if (!$images_src)
                $data['image'] = $edit_user->image_src;
            
            $update = DB::Update($edit_user,$data,array('ID'=>$edit_id));
            if ($update){
                $msg =  "User Updated successfully ";
                $array_of_return = array('message'=>$msg,'stat'=>'success');
            }
                
        } // end update 
    } // end of check email / phone 
    
    } 
    echo json_encode($array_of_return);
    // end action id 
}
die ;