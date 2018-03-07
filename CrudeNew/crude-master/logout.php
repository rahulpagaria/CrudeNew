<?php 
session_start();
if( session_unset('user_id') == true 
		&& session_unset('user_pass')==true ) {
   header('Location: login.php');
   error_log(session_status());
   
   error_log("here1");
   
   session_destroy();
} else {
   unset($_SESSION['user_id']);
   unset($_SESSION['user_pass']);
   $x=session_status();
   error_log("hiworld11");
   
   error_log($x);
   
   session_destroy();
   error_log("here2");
   
   header('Location: login.php');
}
?>