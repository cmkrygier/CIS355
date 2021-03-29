<?php
# This process updates a record. There is no display.
    
    session_start();
    if (!isset($_SESSION['email'])) {
        
        header("Location: login.php");

    } else{
        
        $id=$_GET['id'];
        # 1. connect to database
        require '../database/database_new.php';
        $pdo = Database::connect();

        # 2. assign user info to a variable
        #$m = $_POST['msg'];
                
        $count=0;
        # Clean the posted information before updating the DB
        $firstName=htmlspecialchars($_POST['first_name']);
        $lastName =htmlspecialchars($_POST['last_name']);
        $email =htmlspecialchars($_POST['email']);
        $phone =htmlspecialchars($_POST['phone']);
        $address_one =htmlspecialchars($_POST['address_one']);
        $address_two =htmlspecialchars($_POST['address_two']);
        $city =htmlspecialchars($_POST['city']);
        $state =htmlspecialchars($_POST['state']);
        $zip =htmlspecialchars($_POST['zip']);
        $role =htmlspecialchars($_POST['role']);
        
        # define errors because the user should not be able to update with invalid data.
        $fnameError="";
        $lnameError="";
        $emailError="";
        $phoneError="";
        $addressOneError="";
        $addressTwoError="";
        $cityError="";
        $stateError="";
        $zipError="";
        $emailExistsError="Address already exists. Please Login or use another email to register";
        $required_str="Required";
        
        # check if the user is trying to upgrade their self. They could edit the html textfield and click on update
        # we will let them make the change, but wont let it go to the database.
        $sql3 = "SELECT * FROM persons "
        . " WHERE id=? "
        . " LIMIT 1"
        ;
        
        $query3=$pdo->prepare($sql3);
        $query3->execute(Array($id));
        $result3 = $query3->fetch();
        
        #if the roles do not match it means the user tried to change them we could log this is an attempt to
        #elevate role or just ignore it.
        
        if(strcmp($result3['role'],$role)){
            # assign the role to be equal to the stored DB value
            $role=$result3['role'];
        }
        
        
        # checking all of the item to see if they should throw an error now since they could edit the data
        if (empty($_POST["first_name"]))
            $fnameError=$required_str;
        
        if (empty($_POST["last_name"]))
            $lnameError=$required_str;
        
        if (empty($_POST["phone"]))
            $phoneError=$required_str;
        
        if (empty($_POST["address_one"])){
            
            if (empty($_POST["address_two"])){
                $addressOneError=$required_str;
                }else{
                $addressOneError=$required_str;
            }
        }
           
        if (empty($_POST["city"]))
        $cityError=$required_str;
        
        if (empty($_POST["state"]))
        $stateError=$required_str;
        
        if (empty($_POST["zip"]))
        $zipError=$required_str;
        
        # bulk check several items that would yeild the same error message in a for each loop
        $arr_errors=array();
            
        array_push($arr_errors,$fnameError,$lnameError,$phoneError,$addressOneError,$cityError,$stateError,$zipError);

        foreach($arr_errors as $item){
            #echo($item);
            if($item==$required_str){
                $count=$count + 1;
                echo("$item");
                echo($count);
            }
        }
        
        # check if the email is already taken
        if (empty($_POST["email"])){
            $emailError=$required_str;
            $count=$count + 1;
        } else {
            $sql2 = "SELECT * FROM persons "
            . " WHERE email=? "
            . " LIMIT 1"
            ;
            
            $query2=$pdo->prepare($sql2);
            $query2->execute(Array($email));
            $result2 = $query2->fetch();
            
            if(!$result2['id']==$_GET['id']){
                $emailError=$emailExistsError;
                $count=$count + 1;
            }
        }
        
        # check if the email is in the correct formatting
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
             $emailError = "Invalid email format";
             $count=$count + 1;
         }
        
       # $id=$_GET['id'];
        
        if($count!=0) {
            header("Location: display_update_form.php?"
                    . "first_name=$firstName" . "&"
                    . "last_name=$lastName" . "&"
                    . "email=$email" . "&"
                    . "phone=$phone" . "&"
                    . "address_one=$address_one" . "&"
                    . "address_two=$address_two" . "&"
                    . "city=$city" . "&"
                    . "state=$state" . "&"
                    . "zip=$zip" . "&"
                    . "id=$id". "&"
                    . "fnameError=$fnameError" . "&"
                    . "lnameError=$lnameError" . "&"
                    . "emailError=$emailError" . "&"
                    . "phoneError=$phoneError" . "&"
                    . "addressOneError=$addressOneError" . "&"
                    . "addressTwoError=$addressTwoError" . "&"
                    . "cityError=$cityError" . "&"
                    . "stateError=$stateError" . "&"
                    . "zipError=$zipError");
        } else {
            
           # $id = $_GET['id'];

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
            header("Location: display_list.php?");
           # echo "<p>Your info has been added</p><br>";
           # echo "<a href='display_list.php'>Back to list</a>";

        }
    }
    
?>
