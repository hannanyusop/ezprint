<?php
    require_once '../../env.php';

    if(isset($_SESSION['auth'])){

        #either staff or manager;
        if(!in_array($_SESSION['auth']['role'], [1,2])){
            session_destroy(); #delete all session
            echo "<script>alert('Access denied!');window.location='../login.php';</script>";
        }

    }else{
        echo "<script>alert('Session ended! Please re-login!');window.location='../login.php';</script>";
    }

    $user_id = $_SESSION['auth']['user_id'];

    $result = $db->query("SELECT * FROM users WHERE id=$user_id");
    $user = $result->fetch_assoc();
?>