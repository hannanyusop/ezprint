<?php

function displayPrice($price){

    return "RM ".number_format($price, 2, '.', '');
}

function getUser(){

    $result = $db->query("SELECT * FROM users WHERE id=$_SESSION[user_id]");
    return $result->fetch_assoc();

}

function getYear(){
    $start = 2005;
    $years = [];
    do{
        $years[] = $start; $start++;
    }while($start <= date('Y'));

    return $years;
}

function getStrMonth($int = null){

    $months = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December'
    ];

    if(is_null($int)){
        return $months;
    }

    return $months[$int];

}

function getJobStatus($status = null){

    $statuses = [
        1 => 'Pending',
        2 => 'Accepted',
        3 => 'Completed',
        4 => 'Rejected',
    ];

    if(is_null($status)){
        return $statuses;
    }else{
        return $statuses[$status];
    }

}

function getTransactionType($type){

    $types = [
        1 => 'Top-up',
        2 => 'Payment',
        3 => 'Refund'
    ];

    return $types[$type];
}

#for testing
function dd($data){
    var_dump($data);exit();
}

function getFileExt($file){

    return (file_exists($file)) ? strtoupper(pathinfo($file, PATHINFO_EXTENSION)) : "File Not Found!";
}

function getFileSize($file){
    return (file_exists($file)) ? filesize($file)." KB" : "File Not Found!";
}

function getRole($role_id = null){

    $roles = [
        1 => 'MANAGER',
        2 => 'STAFF',
        3 => 'CUSTOMER'
    ];

    if(is_null($role_id)){
        return $roles;
    }

    return $roles[$role_id];
}

function getBackendRole($role_id = null){

    $roles = [
        1 => 'MANAGER',
        2 => 'STAFF',
    ];

    if(is_null($role_id)){
        return $roles;
    }

    return $roles[$role_id];
}