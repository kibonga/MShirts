<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
// require_once "../config/connection.php";
require_once 'functions.php';

function loadFilters() {

    $cat = selectAllID("categories", "cat_id");
    $brand = selectAllID("brands", "brand_id");
    $color = selectAllID("colors", "color_id");
    
    $res = array(
        "cat" => $cat,
        "brand" => $brand,
        "color" => $color
    );

    return $res;

}




function getAllProductsShop($perPageNum, $pageNum) {

    $start = ($pageNum-1) * $perPageNum;
    // $end = $start + $perPageNum;

    $query = ("SELECT p.prod_id as id, p.prod_name as name, p.price, p.date, c.cat_name as cat, b.brand_name as brand, col.color_name as color,  i.path_thumb as img, i.path_normal as img_normal FROM products p INNER JOIN brands b ON p.brand_id = b.brand_id INNER JOIN categories c ON p.cat_id = c.cat_id INNER JOIN colors col ON p.color_id = col.color_id INNER JOIN image i ON p.img_id = i.img_id WHERE active = 1 ORDER BY p.prod_id ASC LIMIT $start, $perPageNum");
    $products = queryString($query);
    $query = ("SELECT COUNT(*) as amount FROM products WHERE active = 1");
    $amount = queryString($query);

    $resp = array(
        "products" => $products,
        "amount" => $amount,
        "page" => $pageNum
    );

    return $resp;

}




function getFilteredProducts($params) {
    $cat = "";
        $brand = "";
        $color = "";
        $range = "";
        $select = "";
        $search = "";
        
        if(isset($params['cat'])) {
            $cat = $params['cat'];
        }
        if(isset($params['brand'])) {
            $brand = $params['brand'];
        }
        if(isset($params['color'])) {
            $color = $params['color'];
        }
        if(isset($params['select'])) {
            $select = $params['select'];
        }
        if(isset($params['search'])) {
            $search = $params['search'];
        }
        if(isset($params['range'])) {
            $range = $params['range'];
        }
        if(isset($params['perPageNum'])) {
            $perPageNum = $params['perPageNum'];
        }
        if(isset($params['pageNum'])) {
            $pageNum = $params['pageNum'];
        }

        $start = ($pageNum-1) * $perPageNum;


        $condition = "WHERE active = 1";

        if(!empty($cat)) {
            $string = "c.cat_id IN ($cat)";
            (!empty($condition)) ? $condition .= " AND $string" : $condition .= "WHERE $string";
        }
        if(!empty($brand)) {
            $string = "b.brand_id IN ($brand)";
            (!empty($condition)) ? $condition .= " AND $string" : $condition .= "WHERE $string";
        }
        if(!empty($color)) {
            $string = "p.color_id IN ($color)";
            (!empty($condition)) ? $condition .= " AND $string" : $condition .= "WHERE $string";
        }
        if(!empty($range)) {
            $string = "p.price < $range";
            (!empty($condition)) ? $condition .= " AND $string" : $condition .= "WHERE $string";
        }
        if(!empty($search)) {
            $string = "LOWER(p.prod_name) LIKE '%$search%'";
            (!empty($condition)) ? $condition .= " AND $string" : $condition .= "WHERE $string";
        }
        if(!empty($select)) {
            $condition .= " ORDER BY ";
            switch($select) {
                case "newest" : $condition .= "p.date DESC";
                break;
                case "nameAsc" : $condition .= "p.prod_name ASC";
                break;
                case "nameDesc" : $condition .= "p.prod_name DESC";
                break;
                case "priceDesc" : $condition .= "p.price DESC";
                break;
                case "priceAsc" : $condition .= "p.price ASC";
                break;
            }

        }
        else {
            $condition .= " ORDER BY p.prod_id ASC";
        }

        $query = "SELECT p.prod_id as id, p.prod_name as name, p.price, p.date, c.cat_name as cat, b.brand_name as brand, col.color_name as color, i.path_thumb as img, i.path_normal as img_normal FROM products p INNER JOIN brands b ON p.brand_id = b.brand_id INNER JOIN categories c ON p.cat_id = c.cat_id INNER JOIN image i ON p.img_id = i.img_id INNER JOIN colors as col ON p.color_id = col.color_id $condition LIMIT $start, $perPageNum";
        $products = queryString($query);
        $query = "SELECT COUNT(*) as amount FROM products p INNER JOIN brands b ON p.brand_id = b.brand_id INNER JOIN categories c ON p.cat_id = c.cat_id INNER JOIN image i ON p.img_id = i.img_id INNER JOIN colors as col ON p.color_id = col.color_id $condition";
        $amount = queryString($query);

        // display($products);

        $resp = array(
            "products" => $products,
            "amount" => $amount,
            "page" => $pageNum
        );

        // display($resp);

        return $resp;


}



function getProductID($id) {

    if(!isset($id) || empty($id)) {
        header("Location: index.php");
    }

    $query = ("SELECT p.prod_id as id, p.prod_name as name, p.price, p.date, c.cat_name as cat, b.brand_name as brand, col.color_name as color,  i.path_thumb as img, i.path_normal as img_normal, p.prod_desc FROM products p INNER JOIN brands b ON p.brand_id = b.brand_id INNER JOIN categories c ON p.cat_id = c.cat_id INNER JOIN colors col ON p.color_id = col.color_id INNER JOIN image i ON p.img_id = i.img_id WHERE p.prod_id = $id");
    $product = queryString($query);

    $resp = array(
        "product" => $product
    );

    return $resp;

}



function selectProductsID($prods_id) {



    


    $in = "(";
    foreach($prods_id as $i => $prod) {
        $in = $in."$prod,";
    }
    $in = substr($in, 0, -1);
    $in = $in .")";

    $query = ("SELECT p.prod_id as id, p.prod_name as name, p.price, p.date, c.cat_name as cat, b.brand_name as brand, col.color_name as color,  i.path_thumb as img, i.path_normal as img_normal, p.prod_desc FROM products p INNER JOIN brands b ON p.brand_id = b.brand_id INNER JOIN categories c ON p.cat_id = c.cat_id INNER JOIN colors col ON p.color_id = col.color_id INNER JOIN image i ON p.img_id = i.img_id WHERE p.prod_id IN $in");
    $products = queryString($query);


    // $products = selectIN("products", "prod_id", $in, );
    
    return $products;
    

}




