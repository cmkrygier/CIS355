<?php
    
    # connect
    session_start();
    #print_r($_SESSION);
    if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    }
   
require '../database/database_new.php';
#include_once 'get_permissions.php';
    $pdo = Database::connect();

    # put the information for the chosen record into variable $results
    $id = $_GET['id'];
    $sql = "SELECT * FROM persons WHERE id=" . $id;
    $query=$pdo->prepare($sql);
    $query->execute();
    $result = $query->fetch();
     
        
    $sql2 = "SELECT * FROM persons WHERE email=?";
    $query2=$pdo->prepare($sql2);
    $query2->execute(Array($_SESSION['email']));
    $result2 = $query2->fetch();

  #  echo $result2['role'];
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Assignment 16</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
    .create-form {
        width: 500px;
        margin: 60px auto;
    }
    .create-form form {
        margin-bottom: 20px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .create-form h2 {
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

<div class="create-form">
<?php
error_reporting(0);
?>
    <form action="update_record.php?id=<?php echo $id ?>" method="POST">

        <h2 class="text-center">Update <?php echo $result['fname']; ?>'s Information </h2>

        <div class="form-group">
            <label for="first_name">First Name</label>
            <span style='color: red;'><?php echo $_GET["fnameError"]; ?></span>
            <input type="text" class="form-control" placeholder="Jonny"  name="first_name" value='<?php echo $result['fname']; ?>'>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <span style='color: red;'><?php echo $_GET["lnameError"]; ?></span>
            <input type="text" class="form-control" placeholder="Appleseed"  name="last_name" value='<?php echo $result['lname']; ?>'>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <span style='color: red;'><?php echo $_GET["emailError"]; ?></span>
            <input type="text" class="form-control" placeholder="example@svsu.edu"  name="email" value='<?php echo $result['email']; ?>'>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <span style='color: red;'><?php echo $_GET["phoneError"]; ?></span>
            <input type="text" class="form-control" placeholder="(989)788-8887"  name="phone" value = '<?php echo $result['phone']; ?>'>
        </div>
            
        <div class="form-group">
            <label for="address_one">Street Address 1</label>
            <span style='color: red;'><?php echo $_GET["addressOneError"]; ?></span>
            <input type="text" class="form-control" placeholder="123 Drury Lane"  name="address_one" value='<?php echo $result['address']; ?>'>
        </div>

        <div class="form-group">
            <label for="addressTwoError">Street Address 2</label>
            <span style='color: red;'><?php echo $_GET["addressTwoError"]; ?></span>
            <input type="text" class="form-control" placeholder="123 Drury Lane" name="address_two" value= '<?php echo $result['address2']; ?>'>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <span style='color: red;'><?php echo $_GET["cityError"]; ?></span>
            <input type="text" class="form-control" placeholder="University Center"name="city" value ='<?php echo $result['city']; ?>'>
        </div>

        <label for="State">State</label>
        <div class="form-group">
            
            <select name ="state" >
                <option value=<?php echo $result['state']; ?> selected="selected"><?php echo $result['state']; ?></option>
                <option value="Alabama">Alabama</option>
                <option value="Alaska">Alaska</option>
                <option value="Arizona">Arizona</option>
                <option value="Arkansas">Arkansas</option>
                <option value="California">California</option>
                <option value="Colorado">Colorado</option>
                <option value="Connecticut">Connecticut</option>
                <option value="Delaware">Delaware</option>
                <option value="District">District Of Columbia</option>
                <option value="Florida">Florida</option>
                <option value="Georgia">Georgia</option>
                <option value="Hawaii">Hawaii</option>
                <option value="Idaho">Idaho</option>
                <option value="Illinois">Illinois</option>
                <option value="Indiana">Indiana</option>
                <option value="Iowa">Iowa</option>
                <option value="Kansas">Kansas</option>
                <option value="Kentucky">Kentucky</option>
                <option value="Louisiana">Louisiana</option>
                <option value="Maine">Maine</option>
                <option value="Maryland">Maryland</option>
                <option value="Massachusetts">Massachusetts</option>
                <option value="Michigan">Michigan</option>
                <option value="Minnesota">Minnesota</option>
                <option value="Mississippi">Mississippi</option>
                <option value="Missouri">Missouri</option>
                <option value="Montana">Montana</option>
                <option value="Nebraska">Nebraska</option>
                <option value="Nevada">Nevada</option>
                <option value="New Hampshire">New Hampshire</option>
                <option value="New Jersey">New Jersey</option>
                <option value="New Mexico">New Mexico</option>
                <option value="New York">New York</option>
                <option value="North Carolina">North Carolina</option>
                <option value="North Dakota">North Dakota</option>
                <option value="Ohio">Ohio</option>
                <option value="Oklahoma">Oklahoma</option>
                <option value="Oregon">Oregon</option>
                <option value="Pennsylvania">Pennsylvania</option>
                <option value="Rhode Island">Rhode Island</option>
                <option value="South Carolina">South Carolina</option>
                <option value="South Dakota">South Dakota</option>
                <option value="Tennessee">Tennessee</option>
                <option value="Texas">Texas</option>
                <option value="Utah">Utah</option>
                <option value="Vermont">Vermont</option>
                <option value="Virginia">Virginia</option>
                <option value="Washington">Washington</option>
                <option value="West Virginia">West Virginia</option>
                <option value="Wisconsin">Wisconsin</option>
                <option value="Wyoming">Wyoming</option>
            </select>
        </div>

        <div class="form-group">
            <label for="zip">Zip Code</label>
            <input type="text" class="form-control" placeholder="48706" required="required" name="zip" value='<?php echo $result['zip_code']; ?>'>
        </div>
        
        <?PHP
            
            $adminRole="Admin";
            if  (!strcmp($result2['role'],$adminRole)){
                
                # check if this is the logged in user's record
                if (!strcmp($_SESSION['email'],$result['email'])) {
                    
                    read_only_textbox($result['role']);
                    
                } else {
                    
                    drop_down_display($result['role']);
        
                }
                
            } else {
                
                read_only_textbox($result['role']);
      
            }
    
            function read_only_textbox($user_role){
                
                
                echo '<div class="form-group">';
                echo '<label for="role">Role </label>';
                echo '<input type="text" class="form-control" placeholder="48706" name="role" value=' . $user_role .' readonly="readonly">';
                echo '</div>';
            }
            
            
            function drop_down_display($user_role){
                
                echo '<div class="form-group">';
                echo '<label for="role">Role</label>';
                echo '<div class="form-group">';
                echo '<select name ="role" >';
                echo "<option value= ". $user_role ." selected='selected'> ". $user_role ." </option>";
                echo '<option value="Admin">Admin</option>';
                echo '<option value="User">User</option>';
                echo '</select>';
                echo '</div>';
            }
?>
         
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="login">Update</button>
        </div>

    </form>

</div>
</body>
</html>
