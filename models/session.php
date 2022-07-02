<?php
    session_start();
    $USER = false;
    if(isset($_SESSION['user'])) {
        $USER = $_SESSION['user'];
    }