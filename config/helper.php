<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include_once 'db_config.php';

function displayPrice($price){

    return "RM ".number_format($price, 2, '.', '');
}

function getUser(){

    $result = $GLOBALS['db']->query("SELECT * FROM users WHERE id=$_SESSION[user_id]");
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


function getAddOnStatus($status = null){


    $statuses = [
        1 => 'ACTIVE',
        0 => 'DISABLED',
    ];

    return (is_null($status))? $statuses : $statuses[$status];

}

function getOption($name, $default = ''){

    $option_q = $GLOBALS['db']->query("SELECT * FROM options WHERE name='$name'");
    $option = $option_q->fetch_assoc();

    if(!$option){
        return $default;
    }

    return $option['value'];

}

function sendEmail($recipient_email, $subject, $body){

    require '../../vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
//        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = $GLOBALS['smtp_host'];                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $GLOBALS['smtp_username'];                     // SMTP username
        $mail->Password   = $GLOBALS['smtp_password'];                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('noreply@ezprint.my', 'ezPrint No-reply');
        $mail->addAddress($recipient_email);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
//        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}