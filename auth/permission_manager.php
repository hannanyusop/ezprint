<?php
    if(isset($_SESSION['auth'])){

        #manager only
        if($_SESSION['auth']['role'] != 1){
            session_destroy(); #delete all session
            echo "<script>alert('Access denied!');window.location='login.php';</script>";
        }

    }else{
        echo "<script>alert('Session ended! Please re-login!');window.location='login.php';</script>";
    }
?>