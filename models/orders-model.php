<?php 

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
// require_once "config/connection.php";
require_once 'functions.php';


function insertOrders($orders, $user_id) {

    global $conn;

    $res = array();
    if(!empty($orders) && isset($orders) && !empty($user_id) && isset($user_id)) {

        $order_id = queryString("SELECT order_id from orders ORDER BY order_id DESC LIMIT 1");
        $order_id = $order_id[0]->order_id + 1;
        $query = $conn->prepare("INSERT INTO orders (order_id, user_id) VALUES(:order_id, :user_id)");
        $query->bindParam(":order_id", $order_id);
        $query->bindParam(":user_id", $user_id);
        $res = $query->execute();

        if($res) {
            foreach($orders as $i => $o) {
                $query = $conn->prepare("INSERT INTO order_details (order_id, prod_id, quantity, total_price) VALUES (:order_id, :prod_id, :quantity, :total_price)");
                $query->bindParam(":order_id", $order_id);
                $query->bindParam(":prod_id", $o['prod_id']);
                $query->bindParam(":quantity", $o['quantity']);
                $query->bindParam(":total_price", $o['totalPrice']);
                $res = $query->execute();

            }
            if($res) {
                $query = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
                $query->bindParam(":user_id", $user_id);
                $res = $query->execute();
                return "Success";
            }else {
                echo json_encode("Failed to delete from cart", JSON_FORCE_OBJECT);
                http_response_code(500);
            }
            
        }else { 
            echo json_encode("Failed to insert new order", JSON_FORCE_OBJECT);
            http_response_code(500);
        }
        

        

    }else {
        echo json_encode("Invalid user id passed", JSON_FORCE_OBJECT);
        http_response_code(404);
    }

    


}