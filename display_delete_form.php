<?php
    
    session_start();
    if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    }
?>

<?PHP
    # 1. connect to database
    require '../database/database_new.php';
    $pdo = Database::connect();
    
    # 2. assign user info to a variable
    $id = $_GET['id'];
    echo $id;
    $sql2 = "SELECT * FROM persons WHERE id=?";
    $query2=$pdo->prepare($sql2);
    $query2->execute(Array($_GET['id']));
    $result2 = $query2->fetch();

   if (isset($_POST['submit'])){
       # 3. assign MySQL query code to a variable
       $sql = "DELETE FROM persons WHERE id=$id";

       #4. delete the record in the database
       $pdo->query($sql); # execute the query
       
       # redirect back to the displayed list to show the updated changes
       # using th header here will not work because the header has already been sent. Therefore a
       # work around here is to use javascript to do the redirecting and avoid errors
       # header("location: display_list.php");
       echo "<script>";
       echo "window.location ='display_list.php'";
       echo "</script>";
   }
    
?><!DOCTYPE html>
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
        <h3 class="text-center">Are you sure you want to delete the record?</h3>
        <br>
        <div class="form-group">
            <h4 style="text-align:center"> <?php echo $result2["fname"] . " " . $result2["lname"]; ?> </h4>
        </div>
        <br>

        <div class="form-group">
            <button type="submit" name = "submit" class="btn btn-danger btn-block">Yes</button>
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-primary btn-block" onClick="location.href='display_list.php'">No</button>
        </div>

    </form>
</div>
</body>
</html>

