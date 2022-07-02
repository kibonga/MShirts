<?php

function display($content) {

    echo "<pre>";
        print_r($content);
    echo "</pre>";

}

function selectAll($table) {
    global $conn;
    $query = $conn->query("SELECT * FROM $table ORDER BY id ASC");
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function selectIN($table, $column, $arr) {
    global $conn;
    $query = $conn->query("SELECT * FROM $table WHERE $column IN $arr ORDER BY $column ASC");
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function selectAllID($table, $id) {
    global $conn;
    $query = $conn->query("SELECT * FROM $table ORDER BY $id ASC");
    
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function queryString($query) {
    global $conn;
    $query = $conn->query($query);
    return $query->fetchAll(PDO::FETCH_OBJ);
}

// function prepareQueryID($query, $id) {
//     global $conn;
//     // display($query);
//     // display($id);
//     $query = $conn->prepare($query);
//     $query->bindParam(1, $id);
//     // display($query);
//     return $query->fetchAll(PDO::FETCH_OBJ);
// }

function loadNav() {
    $nav = selectAll('navbar');
    return $nav;
}


function active($current_page){
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);  
    if($current_page == $url){
        echo 'active';
    } 
}


