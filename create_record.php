<?PHP
    require '../database/database_new.php';
    $pdo = Database::connect();
    
    $count=0;
    #all new registered will be users. THey need a role and it would not be logical to assign them admin
    
    $firstName =htmlspecialchars($_POST['first_name']);
    $lastName =htmlspecialchars($_POST['last_name']);
    $email =htmlspecialchars($_POST['email']);
    $phone =htmlspecialchars($_POST['phone']);
    $password= htmlspecialchars($_POST['password']);
    $passwordConfirm= htmlspecialchars($_POST['confirm_password']);
    $address_one=htmlspecialchars($_POST['address_one']);
    $address_two=htmlspecialchars($_POST['address_two']);
    $city=htmlspecialchars($_POST['city']);
    $state=htmlspecialchars($_POST['state']);
    $zip=htmlspecialchars($_POST['zip']);
    $role=htmlspecialchars($_POST['role']);
    
    #validate pw strength:
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    
    #validate 10 digit phone number:
    $validPhone = preg_match('/^[0-9]{10}+$/', $phone);
    
    
    # define error variables
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
    $passwordError="";
    $passwordBlankError="Both password fields must be filled in";
    $passwordMatchError="Passwords do not match";
    $passwordRequirementError="Must be 16+ chars, contain upper, lower, num, special char";
    $required_str="Required";

    # checking all of the item to see if they should throw an error due to data formatting
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
        
    array_push($arr_errors,$fnameError,$lnameError,$phoneError,$addressOneError,$cityError,$stateError,$zipError,$passwordBlankError);

    foreach($arr_errors as $item){
    
        if($item==$required_str){
            $count=$count + 1;
        
        }
    }
    
    #check if the passwords are empty or not
    
    if (empty($_POST["password"]) || empty($_POST["confirm_password"])){
        $passwordError=$passwordBlankError;
        $count=$count + 1;
    } else {
        
        #if pw dont match we set the error
       if (strcmp($password,$passwordConfirm)) {
           $passwordError=$passwordMatchError;
           $count=$count + 1;
           } else{
               
               #pw matches so we check the length and criteria
               if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 16){
                   $passwordError=$passwordRequirementError;
                   $count=$count + 1;
               }
           }
    }
        
    # check if the email is already taken
    if (empty($_POST["email"])){
        $emailError=$required_str;
        $count=$count + 1;
    } else {
        $sql = "SELECT * FROM persons "
        . " WHERE email=? "
        . " LIMIT 1"
        ;
        
        $query=$pdo->prepare($sql);
        $query->execute(Array($email));
        $result = $query->fetch();
        
        if($result){
            $emailError=$emailExistsError;
            $count=$count + 1;
        }
    }
    
    # check if the email is in the correct formatting
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $emailError = "Invalid email format";
         $count=$count + 1;
     }
     
     # check if the phone is in the correct 10 digit format
     if (!$validPhone) {
         $phoneError="PLease type in valid 10 digit phone number";
         $count=$count + 1;
     }
    
    # Sending data back to the form if incorrect and providing errors to the user here
    if($count!=0){
       header("Location: display_create_form.php?"
               . "first_name=$firstName" . "&"
               . "last_name=$lastName" . "&"
               . "email=$email" . "&"
               . "phone=$phone" . "&"
               . "address_one=$address_one" . "&"
               . "address_two=$address_two" . "&"
               . "city=$city" . "&"
               . "state=$state" . "&"
               . "zip=$zip" . "&"
               . "fnameError=$fnameError" . "&"
               . "lnameError=$lnameError" . "&"
               . "emailError=$emailError" . "&"
               . "phoneError=$phoneError" . "&"
               . "passwordError=$passwordError" . "&"
               . "addressOneError=$addressOneError" . "&"
               . "addressTwoError=$addressTwoError" . "&"
               . "cityError=$cityError" . "&"
               . "stateError=$stateError" . "&"
               . "zipError=$zipError");
           
    }else{
            # hash the password here because this is the next piece of data that needs to be operated on'
        $password_salt="";
        $password_hash="";
        #$password= htmlspecialchars($password);
        $password_salt= MD5(microtime());
        $password_hash= MD5($password . $password_salt);
        
            # if there are no errors we can go ahead and add the user information to the database here
    
            # 3 assign mysql query code to variable
            $sql = "INSERT INTO persons (role ,fname, lname,email, phone, password_hash, password_salt,address,address2,city,state,zip_code) VALUES (:role,:firstName,:lastName,:email,:phone,:password_hash,:password_salt,:address,:address2,:city,:state,:zip)";
            # using prepares statements to ensure no SQL injection. The variables were already sanitized early
            $prepared_statement = $pdo->prepare($sql);
            $prepared_statement->bindParam( ':role', $role);
            $prepared_statement->bindParam( ':firstName', $firstName);
            $prepared_statement->bindParam( ':lastName', $lastName);
            $prepared_statement->bindParam( ':email', $email);
            $prepared_statement->bindParam( ':phone', $phone);
            $prepared_statement->bindParam( ':password_hash', $password_hash);
            $prepared_statement->bindParam( ':password_salt', $password_salt);
            $prepared_statement->bindParam( ':address', $address_one);
            $prepared_statement->bindParam( ':address2', $address_two);
            $prepared_statement->bindParam( ':city', $city);
            $prepared_statement->bindParam( ':state', $state);
            $prepared_statement->bindParam( ':zip', $zip);
            $prepared_statement->execute();
    
            # inform user their information was added and redirect to the login screen using Javascript
           # header("Location: login.php?");
           echo "<script> alert('New User Added');</script>";
           echo "<script>window.location = 'display_list.php';</script>";
        
    }

