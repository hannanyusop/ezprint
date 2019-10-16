<?php
    if(isset($_SESSION['auth'])){

        #either staff or manager;
        if(!in_array([1,2], $_SESSION['auth']['role'])){
            session_destroy(); #delete all session
            echo "<script>alert('Access denied!');window.location='login.php';</script>";
        }

    }else{
        echo "<script>alert('Session ended! Please re-login!');window.location='login.php';</script>";
    }
?>