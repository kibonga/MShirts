<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
// require_once "../config/connection.php";
require_once 'functions.php';


function insertMessage($fname, $lname, $email, $subject, $message) {

    $errors = false;
    $regName = "/^\w{2,25}$/";
    $regEmail = "/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
    $regSubject = "/(^[\w](( \w+)|(\w*))*$)|(^\w$)/";
    // $regMessage = "/^[\wA-ZŠĐŽČĆa-zšđžčć0-9][\wŠĐČĆŽšđžčć0-9\/\s\.!,?]+$/";

    if(empty($fname)) {
        $_SESSION['fnameCon'] = "This field cannot be empty";
        $errors = true;
    }
    else if(!preg_match($regName, $fname)) {
        $_SESSION['fnameCon'] = "First name is not valid";
        $errors = true;
    }else {
        $_SESSION['fnameCon'] = $fname;
    }

    if(empty($lname)) {
        $_SESSION['lnameCon'] = "This field cannot be empty";
        $errors = true;
    }
    else if(!preg_match($regName, $fname)) {
        $_SESSION['lnameCon'] = "Last name is not valid";
        $errors = true;
    }else {
        $_SESSION['lnameCon'] = $lname;
    }

    if(empty($email)) {
        $_SESSION['lnameCon'] = "This field cannot be empty";
        $errors = true;
    }
    else if(!preg_match($regEmail, $email)) {
        $_SESSION['emailCon'] = "Email is not valid";
        $errors = true;
    }else {
        $_SESSION['emailCon'] = $email;
    }


    if(empty($subject)) {
        $_SESSION['subjectCon'] = "This field cannot be empty";
        $errors = true;
    }
    else if(!preg_match($regSubject, $subject)) {
        $_SESSION['subjectCon'] = "Subject is not valid";
        $errors = true;
    }else {
        $_SESSION['subjectCon'] = $subject;
    }


    if(empty($message)) {
        $_SESSION['messageCon'] = "This field cannot be empty";
        $errors = true;
    }
    else {
        $_SESSION['messageCon'] = $message;
    }
    // else if(!preg_match($regMessage, $message)) {
    //     $_SESSION['messageCon'] = "Message is not valid";
    //     $errors = true;
    // }


    if($errors) {
        return "Errors";
    }else {
        global $conn;
        $fname = addslashes($fname);
        $lname = addslashes($lname);
        $email = addslashes($email);

        $query = $conn->prepare("INSERT INTO messages (email, first_name, last_name, subject, message) VALUES(:email, :fname, :lname, :subject, :message)");
        $query->bindParam(":fname", $fname);
        $query->bindParam(":lname", $lname);
        $query->bindParam(":email", $email);
        $query->bindParam(":subject", $subject);
        $query->bindParam(":message", $message);

        $res = $query->execute();


        if($res == 1) {
            return "Success";
        }
        else {
            echo json_encode("Failed to insert new message", JSON_FORCE_OBJECT);
            http_response_code(500);
            return "Failed";
        }

    }

}

