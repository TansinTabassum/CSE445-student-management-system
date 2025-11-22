<?php
if(isset($_SESSION['user']))//if user session is not set
{
    // user is not log in 
    // redirect to log in page with msg
    $_SESSION['no-login-msg']= "<div class ='error' >please login to access msg </div>";
    header('location:' .SITEURL. 'admin/login.php');
}
?>