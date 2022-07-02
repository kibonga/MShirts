<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if(isset($_SESSION['loggedUser'])) {
    // unset($_SESSION['loggedUser']);
    session_destroy();
}
header("Location: ../index.php");

