<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
// require_once "../config/connection.php";
require_once 'functions.php';

function logoutCustomer($user_id, $prods = null) {
    global $conn;

    $res = array();
    // display(count($prods));
    if(!empty($prods) && isset($prods) && count($prods)) {

        $query = $conn->prepare("SELECT * FROM cart WHERE user_id = :user_id");
        $query->bindParam(":user_id", $user_id);
        $query->execute();

        if($query->rowCount() > 0) {
            $query = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
            $query->bindParam(":user_id", $user_id);
            $query->execute();
        }else {
            echo json_encode("Failed to delete products from cart", JSON_FORCE_OBJECT);
            http_response_code(500);
        }

        foreach($prods as $i => $prod) {
            $query = $conn->prepare("INSERT INTO cart (user_id, prod_id, quantity) VALUES(:user_id, :prod_id, :quantity)");
            $query->bindParam(":user_id", $user_id);
            $query->bindParam(":prod_id", $prod['prod_id']);
            $query->bindParam(":quantity", $prod['quantity']);
            $res[] = $query->execute();

        }

    }
    session_destroy();
    $resp = array("msg" => "Logged out");
    foreach($res as $i => $val) {
        if($val != 1) {
            echo json_encode("Failed to insert products into cart", JSON_FORCE_OBJECT);
            http_response_code(500);
        }
    }

    

    return $resp;
    


}