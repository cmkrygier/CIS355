<?php
    
    function get_user_permissions($email_address){
       
        #$sql = "SELECT role FROM persons WHERE email=$email_address";
        $sql = "SELECT role FROM persons WHERE email='$email_address'";
        # 4. insert the message into the database
        $pdo->query($sql); # execute the query
        
        
        return $total;
    }
    
    
?>

<?php
# This process updates a record. There is no display.
    
    session_start();
    if (!isset($_SESSION['email'])) {
    header("Location: login.php");

        
    } else{
        
        # 1. connect to database
        require '../database/database_new.php';
        $pdo = Database::connect();

        # 2. assign user info to a variable
        $m = $_POST['msg'];
            
        # Cleant the posted information before updating the DB
        $firstName =htmlspecialchars($_POST['first_name']);
        $lastName =htmlspecialchars($_POST['last_name']);
        $email =htmlspecialchars($_POST['email']);
        $phone =htmlspecialchars($_POST['phone']);

        #password fields
        #$password =htmlspecialchars($_POST['password']);
        #$confirm_password =htmlspecialchars($_POST['confirm_password']);

        #continued posted fields
        $address_one =htmlspecialchars($_POST['address_one']);
        $address_two =htmlspecialchars($_POST['address_two']);
        $city =htmlspecialchars($_POST['city']);
        $state =htmlspecialchars($_POST['state']);
        $zip =htmlspecialchars($_POST['zip']);
        $role =htmlspecialchars($_POST['role']);
           
        $id = $_GET['id'];

        # 3. assign MySQL query code to a variable
        #$sql = "UPDATE messages SET message= :m WHERE id= :id";
            $sql="Update persons SET role=:role,fname=:firstName,lname=:lastName,email=:email,phone=:phone,address=:address,address2=:address2,city=:city,state=:state,zip_code=:zip WHERE id=:id";
            
            # prepared statement
            $prepared_statement = $pdo->prepare($sql);
            $prepared_statement->bindParam( ':role', $role);
            $prepared_statement->bindParam( ':firstName', $firstName);
            $prepared_statement->bindParam( ':lastName', $lastName);
            $prepared_statement->bindParam( ':email', $email);
            $prepared_statement->bindParam( ':phone', $phone);
            $prepared_statement->bindParam( ':address', $address_one);
            $prepared_statement->bindParam( ':address2', $address_two);
            $prepared_statement->bindParam( ':city', $city);
            $prepared_statement->bindParam( ':state', $state);
            $prepared_statement->bindParam( ':zip', $zip);
            $prepared_statement->bindParam( ':id', $id);
            

            $prepared_statement->execute();

        # 4. update the message in the database
        #$pdo->query($sql); # execute the query
            
        echo "<p>Your info has been added</p><br>";
        echo "<a href='display_list.php'>Back to list</a>";

        
    }
    

?>
