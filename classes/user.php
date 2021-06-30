<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/classes/DB.php');
Class User Extends Template{
    //`ID`, `email`, `name`, `password`, `mobile`, `created_at`, `created_by`, `role`, `image`
    private $id ,$role;
    public $email,$name,$password, $mobile , $created_by,$image,$image_src;
    
    public function __construct($id = 0 ){
        
        $this->table_name='users';
        
        require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/config.php');
        if ($id) {
            $pdo1 = new PDO(Dns, Dbuser, Dbpassword);
            $stmt = $pdo1->prepare("select * from users where ID = '".$id."'");
            $stmt->execute();
            $array_of_args =   $stmt->fetch(\PDO::FETCH_ASSOC);
            
            if (!$array_of_args) {
                $this->id  = false ;
                return ; 
            }
            
        } else return ;
        
        
        $this->id       =  $array_of_args['ID'] ;
        $this->email    = $array_of_args['email'];
        $this->name     = $array_of_args['name'];
        $this->password = $array_of_args['password'];
        $this->mobile   = $array_of_args['mobile'];
        $this->created_at = $array_of_args['created_at'];
        $this->created_by = $array_of_args['created_by'];
        $this->role     = $array_of_args['role'];
        $this->image    = $this->get_image($array_of_args['image']);
        $this->image_src    = $array_of_args['image'];
        
    }
    
    
    
    public function get_image($image){
        //echo $image.'===';
        return is_file($_SERVER['DOCUMENT_ROOT'].'/Auth/uploads/'.$image)? '../Auth/uploads/'.$image
                :'https://cdn2.iconfinder.com/data/icons/avatars-99/62/avatar-370-456322-512.png';
    }
    
    public function get_role(){
        return $this->role;
    }
    
    public function get_ID(){
        return $this->id;
    }
    
    static function get_all($role){
        
        if ($role =='super-admin')
            $str = "  or role='admin'  or role='super-admin'";
        
        require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/config.php');
        $pdo1 = new PDO(Dns, Dbuser, Dbpassword);
        $stmt = $pdo1->prepare("Select * from users where role = 'user'".$str );
        $stmt->execute();
        return  $stmt->fetchAll();
        
    }
    
    static function checkExist($col , $value , $cond){
        require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/config.php');
        $pdo1 = new PDO(Dns, Dbuser, Dbpassword);
        //echo "SELECT `ID` FROM `users` WHERE `$col`=:$col $cond ".$value;
        $stmt = $pdo1->prepare("SELECT `ID` FROM `users` WHERE `$col`=:$col $cond");
        $stmt->bindValue("$col",$value);
        $stmt->execute();
        return $row_email = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}