<?php
       
     require '../database/database_new.php';
   
    function get_user_permissions($email_address){
        
        $pdo = Database::connect();
        #$sql = "SELECT role FROM persons WHERE email=$email_address";
        $sql = "SELECT role FROM persons WHERE email=" . $email_address;
   
        $query=$pdo->prepare($sql);
        $query->execute();
        $result =$query->fetch();
       #echo $result;
        return $result['role'];
    }
    
    
  #  echo get_user_permissions("test@test.com");
?>

