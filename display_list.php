
<?php
# using php to finish the table creation

session_start();
if (!isset($_SESSION['email']))
    header("Location: login.php");

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Assignment 16</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
    .display-users {
        width: 1000px ;
        margin: 0px auto;
    }
    table{
        border-collapse: collapse;
        width: 80%;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    }

 
    .btn {
        font-size: 15px;
        font-weight: bold;
    }
    div.able_padding

</style>
</head>
<body>

<div class="display-users">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Permissions</th>
      <th scope="col">Email</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
<tbody>

<?PHP
    #define a variable to compare and build the form according to the user;s role
    $adminRole="Admin";
    # display link to "create" form
    
    echo "<h2>Registered Users</h2>";

    
    require '../database/database_new.php';
    $pdo = Database::connect();

    $sql2 = "SELECT * FROM persons WHERE email=?";
    $query2=$pdo->prepare($sql2);
    $query2->execute(Array($_SESSION['email']));
    $result2 = $query2->fetch();

    #second query is done here
    $sql = 'SELECT * FROM persons';
    
    if(!strcmp($result2['role'],$adminRole)){
        create_create_button();
    }
    
    
    
    create_logout_button();
    
    foreach ($pdo->query($sql) as $row) {
 
        echo "<tr>";
        echo "<th>" . $row['id'] . "</th>";
        echo "<td>" . $row['fname'] . "</td>";
        echo "<td>" . $row['lname'] . "</td>";
        echo "<td>" . $row['role'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>";
        
      
        if  (!strcmp($result2['role'],$adminRole)){
            
            #check if the record being made is the users record, if so, dont include delete button
            if (!strcmp($result2['email'],$row['email'])){

                #admin can view and update only
                only_update($row['id']);
                only_view($row['id']);
                
            } else {
                
               # Admin can view update and delete
                #view_update_delete($row['id']);
                only_delete($row['id']);
                only_update($row['id']);
                only_view($row['id']);
            }
            
        }else {
            # the role is a user not an admin. So they can only view and update self
            #check if the record is their own and allow an update button to be made
            if (!strcmp($result2['email'],$row['email'])){
                
                only_view($row['id']);
                only_update($row['id']);
                
            } else {
                
                only_view($row['id']);
            }
        }
        #echo the ending tags for the loops iteration
        echo"</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "</body>";
    echo "</html>";

function only_view($id_number){
    echo "<a href='display_read_form.php?id=" . $id_number . "' class='btn btn pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> View";
    echo "</a>";
}

function only_update($id_number){
    echo "<a href='display_update_form.php?id=" .$id_number . "' class='btn btn pull-right'>";
        echo "<span class='glyphicon glyphicon-edit'></span> Update";
    echo "</a>";
    
}
function only_delete($id_number){
    echo "<a href='display_delete_form.php?id=" . $id_number . "' class='btn btn pull-right'>";
        echo "<span class='glyphicon glyphicon-trash'></span> Delete";
    echo "</a>";
}

function create_logout_button(){
    echo "<div class='right-button-margin'>";
        echo "<a href='logout.php' class='btn btn-danger pull-right'>";
        echo "<span class='glyphicon glyphicon-log-out'></span> Log out";
        echo "</a>";
    echo "<div>";
}

function create_create_button(){
    echo "<div class='right-button-margin'>";
        echo "<a href='display_create_form.php' class='btn btn-success pull-left'>";
        echo "<span class='glyphicon glyphicon-plus-sign'></span> Create";
        echo "</a>";
    echo "<div>";
}

?>
