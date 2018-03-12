<?php
require ('dbconnect.php');

if (isset($_POST['user_id']) and isset($_POST['user_pass'])) {
    
    // Assigning POST values to variables.
    $username = $_POST['user_id'];
    $password = $_POST['user_pass'];
    
    // CHECK FOR THE USERID FROM TABLE: The password can be hashed
    $query = "SELECT * FROM `user_login` WHERE username='$username' and Password='$password'";
    
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
    // simple y / n
    if ($count == 1) {
        
        // echo "<script type='text/javascript'>alert('Login Credentials verified')</script>";
        
        // $_SESSION['login'] = TRUE;
        // session_start();
        include "index.php";
    } else {
        // echo "<script type='text/javascript'>alert('Invalid Login Credentials')</script>";
        echo "Invalid Login Credentials";
        // show the loginform again.
        include "login.php";
    }
}
?>