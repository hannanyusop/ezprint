<?php
require_once '../env.php';

function displayPrice($price){

    return "RM ".number_format($price, 2, '.', '');
}

function getUser(){

    $result = $db->query("SELECT * FROM users WHERE id=$_SESSION[user_id]");
    return $result->fetch_assoc();

}