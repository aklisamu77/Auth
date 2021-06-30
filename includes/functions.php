<?php
// do login
function login_auth($auth , $pass ,$hash='md5',$action='redirect'){
        global $con ; 
        
        $select ="mobile='$auth' Or email='$auth'";
        
         $query = "select * from users where (  $select) AND password=$hash('$pass')";
        
        $res = mysqli_query($con ,$query);
        //var_dump($res) ; die ;
        if ($res->num_rows == 0){
            if ($action == 'redirect') //{echo $_SERVER['DOCUMENT_ROOT']."/Auth/login?error=wrong_auth"; die ;}
                header("location:../login?error=wrong_auth");
            else return false;
            
        } else if ( $user = mysqli_fetch_assoc($res) ) {
            if ($user['role'] == 'admin' || $user['role'] == 'super-admin'  ){
                if ( !empty($_POST['remmeber']) && $_POST['remmeber'] ==1  ){
                    setcookie('user_email',$user['email'],time()+60*60*24*30,'/');
                    setcookie('user_password',md5($pass),time()+60*60*24*30,'/');
                }
                // set session
                $_SESSION['user'] = $user['ID'];
                header("location:../profile");
            }
            else header("location:../login?error=user_auth");
        }
}

// check login and back user info 
function get_user_login($action='return'){
    
    global $con;
//echo $_SESSION['user']; die ;
    if (empty($_SESSION['user']) ){
            if (!empty ($_COOKIE['user_email']) && !empty($_COOKIE['user_password'])){
                login_auth( $_COOKIE['user_email'] , $_COOKIE['user_password'],'','return');
                
            }
            else if ($action == 'redirect')
                header("location:".$_SERVER['DOCUMENT_ROOT']."/Auth/login");
            else return false;
    }
    else {
        // get user
        //require('./includes/db.php');
        $query = "select * from users where ID = '".$_SESSION['user']."'";
        $res = mysqli_query($con ,$query);
        if ($res->num_rows == 0) { echo 'Your Account Deleted'; die ;}
        else if ($user = mysqli_fetch_assoc($res)){
            return $user;
        }
    
    
    }
}

// get current user ID
function get_current_user_ID(){
 if (!isset($_SESSION['user'])) return false ;
    return $_SESSION['user'];
}

// is get curent user role
function get_user_role($id ='current' ){
    global $con;
    if (!isset($_SESSION['user'])) return false ;
    if ($id =='current'  ) $id = $_SESSION['user'];
    $query = "select * from users where ID = '".$id."'";
    $res = mysqli_query($con ,$query);
    if ($res->num_rows == 0) { return false ; }
        else if ($user = mysqli_fetch_assoc($res)){
            return $user['role'];
        }
}

// get number of
// get number of customers
function get_number_customer(){
    global $con;
    $query = "select Count(ID) as num from users where role = 'user'";
    $res = mysqli_query($con ,$query);
    if ($res->num_rows == 0) { return false ; }
        else if ($user = mysqli_fetch_assoc($res)){
            return $user['num'];
        }
}

// get number of customers
function get_categories($cond = 'is null'){
    global $con;
    $query = "select * from category where parent $cond";
    $res = mysqli_query($con ,$query);
    $cats = array();
    if ($res->num_rows == 0)  return false ; 
    else while($row = mysqli_fetch_assoc($res))
                $cats[] = $row;   
    return $cats;
}

function get_all($table_name , $cond=1){
    global $con;
    $query = "select * from $table_name where $cond";
    $res = mysqli_query($con ,$query);
    $elements = array();
    if ($res->num_rows == 0)  return false ; 
    else while($row = mysqli_fetch_assoc($res))
                $elements[] = $row;   
    return $elements;
}

// check images
function NotImageVaild($image  , $max_size = 1024 * 1024){
    
    if (empty($image['name'])) return true ;
    $image_info = getimagesize($image['tmp_name']);
    
    if (!isset($image['name']) || empty($image['name']) ||
                !$image_info || ( $image_info['mime']!='image/png' &&  $image_info['mime']!='image/jpeg') ||
               $image['size'] > $max_size )
        return true ;
    else return false ;
}
// uplaod image
function uploadImage($image){
    $target_dir     = $_SERVER['DOCUMENT_ROOT']."/Auth/uploads/";
    $target_name    = rand(1,1000).'-'.rand(1,1000).'-'.rand(1,1000).'.'
                    . pathinfo($image["name"] ,PATHINFO_EXTENSION);
    $target_file = $target_dir .$target_name; //get the file extension and append it to the new file name
    if (move_uploaded_file($image["tmp_name"], $target_file))
        return $target_name;
}

function rearrange_files($arr) {
    foreach($arr as $key => $all) {
        foreach($all as $i => $val) {
            $new_array[$i][$key] = $val;    
        }    
    }
    return $new_array;
}

// products
function get_all_products($cond = 1){
    global $con;
 $sql =' SELECT p.ID,p.name,p.image,p.price,p.description,p.`sale-price`,c.name as cat_name,c.id as cat_id
        FROM `products` as p inner join category as c on(p.parent = c.ID)
        where '.$cond.' order by p.ID DESC';
$res = mysqli_query($con ,$sql);
$products = array();
if ($res->num_rows != 0)  
    while($row = mysqli_fetch_assoc($res))
                $products[] = $row;
return $products;
}