<?php 

// start the session
session_start();
// clear session values
session_unset();
// destroy session variables
session_destroy();
// redirect user to login page
header('Location: login.php');
exit;

?>