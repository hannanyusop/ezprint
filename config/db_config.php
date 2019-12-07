<?php

    $GLOBALS['db'] = $db = new mysqli("localhost", "root", "", "ezprint");

    if($db->connect_error){
        header('Location: ../error.php');
    }

?>