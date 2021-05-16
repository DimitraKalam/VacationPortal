<?php
//if the logout_btn is clicked end the session and redirect to login.php
session_start();
session_destroy();
header ("Location: login.php");
?>
