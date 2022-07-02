<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require_once "../config/connection.php";
require_once 'functions.php';

function getAllOrdersID($user_id, $perPageNum, $pageNum) {

    if((!empty($user_id) && isset($user_id))) {

    global $conn;
    $start = ($pageNum-1) * $perPageNum;

    $query = ("SELECT DISTINCT od.order_id FROM order_details  od INNER JOIN orders o ON od.order_id = o.order_id WHERE o.user_id = $user_id ORDER BY order_id ASC LIMIT $start, $perPageNum");
    $ID = queryString($query);

        $orders = null;
        $amount = 0;
        if(!empty($ID)) {
            $in = "(";
            foreach($ID as $i => $id) {
                $in = $in."$id->order_id,";
            }
            $in = substr($in, 0, -1);
            $in = $in .")";


            $query = $conn->prepare("SELECT o.order_id, u.id as user_id, u.username as customer, p.prod_id, p.prod_name,  c.cat_name as cat, b.brand_name as brand, col.color_name as color, i.path_thumb as img_thumb, i.path_normal as img_normal, od.quantity, p.price as prod_price,  od.total_price, o.order_date FROM products p INNER JOIN order_details od ON p.prod_id = od.prod_id INNER JOIN orders o ON o.order_id = od.order_id INNER JOIN users u ON o.user_id = u.id INNER JOIN brands b ON p.brand_id = b.brand_id INNER JOIN categories c ON p.cat_id = c.cat_id INNER JOIN image i ON p.img_id = i.img_id INNER JOIN colors col ON col.color_id = p.color_id WHERE o.user_id = :user_id AND o.order_id IN $in ORDER BY o.order_id ASC");
            $query->bindParam(":user_id", $user_id);
            $query->execute();
            if($query->rowCount() > 0) {
                $orders = $query->fetchAll(PDO::FETCH_OBJ);
            // display($orders);
                $query = ("SELECT COUNT(*) as amount FROM orders WHERE user_id = $user_id");
                $amount = queryString($query);
            }
        }
        
        // $query = ("SELECT DISTINCT order_id FROM orders WHERE user_id = $user_id");
        // $distinctOrders = queryString($query);

        $resp = array(
            "orders" => $orders,
            "amount" => $amount,
            "page" => $pageNum,
            "dist" => $ID
        );
    

        return $resp;
    }
    else {
        echo json_encode("Invalid user id passed", JSON_FORCE_OBJECT);
        http_response_code(404);
    }

}


function getAllMessagesID($user_id, $perPageNum, $pageNum) {
    global $conn;

    if((!empty($user_id) && isset($user_id))) {
        $start = ($pageNum-1) * $perPageNum;

        $query = $conn->prepare("SELECT email FROM users WHERE id = :user_id");
        $query->bindParam("user_id", $user_id);
        $query->execute();
        if($query->rowCount() > 0) {
            $email = $query->fetchAll(PDO::FETCH_OBJ);
            $email = $email[0]->email;
            // display($email);
            // display($email[0]->email);
            $query = $conn->prepare("SELECT * FROM messages WHERE email = :email ORDER BY msg_id ASC LIMIT $start, $perPageNum");
            $query->bindParam(":email", $email);
            $query->execute();
            $messages = $query->fetchAll(PDO::FETCH_OBJ);
            // display($messages); 

            $query = $conn->prepare("SELECT COUNT(*) as amount FROM messages WHERE email = :email");
            $query->bindParam(":email", $email);
            $query->execute();
            if($query->rowCount() > 0) {
                $amount = $query->fetchAll(PDO::FETCH_OBJ);
            }
            else {
                $amount = 0;
            }
            

            // display("amount: ");
            // display($amount);

            return array(
                "messages" => $messages,
                "amount" => $amount,
                "page" => $perPageNum
            );
        }
        else {
            echo json_encode("Could not find messages for that user", JSON_FORCE_OBJECT);
            http_response_code(500);
        }
    }else {
        echo json_encode("Invalid user id passed", JSON_FORCE_OBJECT);
        http_response_code(404);
    }

}