<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
    <title>Assignment 16</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        .register-form {
            width: 500px;
            margin: 10px auto;
        }
        .register-form form {
            margin-bottom: 30px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .register-form h2 {
            margin: 0 0 15px;
        }
        .register-control, .btn {
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
       
    <div class="register-form">
        <form action="register_processing.php" method="POST">
            
        <?php
        error_reporting(0);
        ?>
            <h2 class="text-center">Register</h2>

            <div class="form-group">
                <label for="first_name">First Name</label>
                <span style='color: red;'><?php echo $_GET["fnameError"]; ?></span>
                <input type="text" class="form-control" placeholder="Johnny" name="first_name" value='<?php echo $_POST["first_name"]; ?>'>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <span style='color: red;'><?php echo $_GET["lnameError"]; ?></span>
                <input type="text" class="form-control" placeholder="Appleseed" name="last_name" value='<?php echo $_POST["last_name"]; ?>'>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <span style='color: red;'><?php echo $_GET["emailError"]; ?></span>
                <input type="text" class="form-control" placeholder="example@svsu.edu"  name="email" value='<?php echo $_POST["email"]; ?>'>
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <span style='color: red;'><?php echo $_GET["phoneError"]; ?></span>
                <input type="text" class="form-control" placeholder="(989)788-8887" name="phone" value='<?php echo $_POST["phone"]; ?>'>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <span style='color: red;'><?php echo $_GET["passwordError"]; ?></span>
                <input type="password" class="form-control" placeholder="Password"  name="password">
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Confirm Password"  name="confirm_password" >
            </div>
                
            <div class="form-group">
                <label for="address_one">Street Address 1</label>
                <span style='color: red;'><?php echo $_GET["addressOneError"]; ?></span>
                <input type="text" class="form-control" placeholder="123 Drury Lane" name="address_one" value='<?php echo $_POST["address_one"]; ?>'>
            </div>

            <div class="form-group">
                <label for="address_two">Street Address 2</label>
                <input type="text" class="form-control" placeholder="123 Drury Lane"  name="address_two" value='<?php echo $_POST["address_two"]; ?>'>
            </div>

            <div class="form-group">
                <label for="city">City</label>
            <span style='color: red;'><?php echo $_POST["cityError"]; ?></span>
                <input type="text" class="form-control" placeholder="University Center"  name="city" value='<?php echo $_POST["city"]; ?>'>
            </div>

            <label for="state">State</label>
            <div class="form-group">
                
                <select name ="state" >
                    <option value="<?php echo $_POST["state"]; ?>" selected="selected"><?php echo $_POST["state"]; ?></option>
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
                    <option value="Michigan"<?php if (empty($_GET["state"])) echo "selected";?>>Michigan</option>
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
                <span style='color: red;'><?php echo $_GET["zipError"]; ?></span>
                <label for="zip">Zip Code</label>
                <input type="text" class="form-control" placeholder="48706" name="zip" value='<?php echo $_POST["zip"]; ?>' >
            
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="register">Register</button>
            </div>
        </form>
    </div>
</body>
</html>
