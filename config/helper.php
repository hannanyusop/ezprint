<?php

function displayPrice($price){

    return "RM ".number_format($price, 2, '.', '');
}

function getUser(){

    $result = $db->query("SELECT * FROM users WHERE id=$_SESSION[user_id]");
    return $result->fetch_assoc();

}

function getJobStatus($status){

    $statuses = [
        1 => 'Pending',
        2 => 'Accepted',
        3 => 'Completed',
        4 => 'Rejected',
    ];

    return $statuses[$status];
}

#for testing
function dd($data){
    var_dump($data);exit();
}