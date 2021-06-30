<?php

Class Template{
    
    public $table_name;
}

Class DB{
    
    static function Delete(Template $model ){
        require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/config.php');
        $pdo1 = new PDO(Dns, Dbuser, Dbpassword);
        // stmt
        $stmt = $pdo1->prepare("Delete from ".$model->table_name." where id =:id");
        $stmt->bindValue("id",$model->get_ID());
        $stmt->execute();
        $pdo1 = null;
        
    }
    
    static function Insert(Template $model , $data){
        require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/config.php');
        $pdo1 = new PDO(Dns, Dbuser, Dbpassword);
        
        // stmt
        $stmt = $pdo1->prepare("insert into ".$model->table_name." (".implode(' , ',array_keys($data)).")
                                values (:".implode(' ,:',array_keys($data)).")");
        foreach($data as $key => $val)
            $stmt->bindValue($key,$val);
        
        
        $stmt->execute();
        
        $pdo1= null;
        if ( $stmt->rowCount() > 0) return true ; 
    }
    
    static function Update(Template $model , $data , $dataSelect){
        require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/includes/config.php');
        $pdo1 = new PDO(Dns, Dbuser, Dbpassword);
        
        // stmt
            // UPDATE `users` SET `id`=[value-1],`name`=[value-2],`balance`=[value-3],`mobile`=[value-4],
            // `password`=[value-5] WHERE 1
        $stmt_cols = $stmt_choose = '';
        foreach ($data as $key => $value )
            $stmt_cols.=    $key .'= :'. $key.',';
        $stmt_cols = substr($stmt_cols, 0, -1);

        foreach ($dataSelect as $key => $value )
            $stmt_choose.=  $key .'= :'. $key.' ,';
        $stmt_choose = substr($stmt_choose, 0, -1);
        //echo  "Update ".$model->table_name." Set $stmt_cols where $stmt_choose";
        //die ; 
        $stmt = $pdo1->prepare("Update ".$model->table_name." Set $stmt_cols where $stmt_choose");
        foreach($data as $key => $val)
            $stmt->bindValue($key,$val);
        foreach($dataSelect as $key => $val)
            $stmt->bindValue($key,$val);
        
        
        $stmt->execute();
        //print_r($stmt->errorInfo());
        $pdo1= null;
        return true ;
    }
}