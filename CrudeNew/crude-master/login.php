<!DOCTYPE html >
<html>
<head>
<title>PD LOGIN FORM</title>
<link rel="stylesheet" type="text/css" href="style.css">

<div class="fixed-header" align="center">
        <div class="container">
            <nav>
                <a href="./contact.html">Home</a>
                <a href="./about.html">About</a>
                <a href="./products.html">Products</a>
                <a href="./services.html">Services</a>
                <a href="./contact.html">Contact Us</a>
            </nav>
        </div>
</head>
<body id="body_bg">


<div align="center">

<h3>Prime Distributors, LLC</h3> <h4> Employee Management Page</h4>
    <form id="login-form" method="post" action="authen_login.php" >
<div class="jumbotron text-center">
 <a href=""><img src="trpd.png" class="img-fluid" alt="pd logo"
width="180"></a>
</div>        <table border="0.5" >
            <tr>
                <td><label for="user_id">User Name</label></td>
                <td><input type="text" name="user_id" id="user_id"></td>
            </tr>
            <tr>
               <td><label for="user_pass">Password</label></td>
                <td><input type="password" name="user_pass" id="user_pass"></input></td>
            </tr>
			
            <tr>
				                    <!-- <input type="submit"  value="Submit">  -->    
				
                <td><input type="submit" value="Submit" />
                <td><input type="reset" value="Reset"/>
				
            </tr>
        </table>
    </form>
		</div>
</body>

<div class="fixed-footer">
        <div class="container">
        
        <?php

include 'footer.php';

?>
        
        </div>        
    </div>
</html>