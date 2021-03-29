<?php
session_start();
if (!isset($_SESSION['email'])) {
header("Location: login.php");
}
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
    <form action="" method="post">

        <h2 class="text-center">Create New User</h2>

        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" placeholder="Jonny" required="required" name="first_name">
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" placeholder="Appleseed" required="required" name="last_name">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" placeholder="example@svsu.edu" required="required" name="email">
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" placeholder="(989)788-8887" required="required" name="phone">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" placeholder="Password" required="required" name="password">
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" placeholder="Confirm Password" required="required" name="confirm_password">
        </div>
            
        <div class="form-group">
            <label for="address_one">Street Address 1</label>
            <input type="text" class="form-control" placeholder="123 Drury Lane" required="required" name="address_one">
        </div>

        <div class="form-group">
            <label for="address_two">Street Address 2</label>
            <input type="text" class="form-control" placeholder="123 Drury Lane" required="required" name="address_two">
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" placeholder="University Center" required="required" name="city">
        </div>

        <label for="State">State</label>
        <div class="form-group">
            
            <select name ="State" >
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="DC">District Of Columbia</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
            </select>
        </div>

        <div class="form-group">
            <label for="zip">Zip Code</label>
            <input type="text" class="form-control" placeholder="48706" required="required" name="zip">
        </div>
        
            <label for="role">Role</label>
            <div class="form-group">
        
            <select name ="role" >
            <option value="Admin">Admin</option>
            <option value="User" selected>User</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="login">Create</button>
        </div>
    </form>

    

</div>
</body>
</html>

