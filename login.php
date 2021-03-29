
<?php
    // ini_set("display_errors", 1);
    // error_reporting(E_ALL);
    // error reporting(0);
    session_start();
    
        $errMsg=''; // initialize message to display on HTML form
        if (isset($_POST['email'])
            && !empty($_POST['email'])
            && !empty($_POST['password'])) {
                
            # prevent HTML/CSS/JS injection
            $email = $_POST['email'];
            $password = $_POST['password'];
            $email = htmlspecialchars($email);
            $password = htmlspecialchars($password);

        
                # check database for legit username
                require '../database/database_new.php';
                $pdo = Database::connect();
                $sql = "SELECT * FROM persons "
                    . " WHERE email=? "
                    . " LIMIT 1"
                    ;
                $query=$pdo->prepare($sql);
                $query->execute(Array($email));
                $result = $query->fetch(PDO::FETCH_ASSOC);
                
                # if user typed legit username, verify SALTED password
                if ($result) {
                    
                    $password_hash_db = $result['password_hash'];
                    $password_salt_db = $result['password_salt'];
                    $password_hash    = MD5($password + $password_salt_db);
                    
                    // if password id correct, redirect
                    if(!strcmp($password_hash, $password_hash_db)) {
                        $_SESSION['email'] = $result['email'];
                        header('Location: display_list.php'); // redirect
                    }
                    // otherwise redisplay login screen
                    else {
                        $errMsg='Login failure: wrong password';
                    }

                }
                
            else
                $errMsg='Login failure: wrong username or password';
            }
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Assignment 16</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    .login-form {
        width: 340px;
        margin: 50px auto;
    }
    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
    <form action="" method="post">
<?php
error_reporting(0);
?>
        <h2 class="text-center">Log in</h2>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Email" required="required" name="email">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required="required" name="password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div>
            <p class="text-center"><a href="register.php">Register</a></p>
        </div>
    </form>
   
</div>
</body>
</html>
