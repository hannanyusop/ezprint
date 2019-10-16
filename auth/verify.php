<?php

require_once '../env.php';

if(isset($_POST['email']) && isset($_POST['password'])){

    $email = $_POST['email']; $password = $_POST['password'];

    $result = $db->query("SELECT * FROM users WHERE email='$email' AND password ='$password'");
    $user = $result->fetch_assoc();

    $ip = $_SERVER['REMOTE_ADDR'];

    if($user){
//        var_dump($user);exit();

        $q = $db->query("UPDATE users SET last_ip_address='$ip', last_login_at=now() WHERE id=$user[id]");
        $x = $db->query($q);

        $_SESSION['auth'] = [
            'user_id' => $user['id'],
            'role' => (int)$user['role_id'],
            'fullname' => $user['fullname'],
        ];

        if($user['role_id'] == 3){
            #customer

            header('Location:customer/dashboard.php');

        }elseif($user['role_id'] == 2 && $user['role_id'] == 1){
            #staff & manager
            print_r('staff & manager');exit();
        }

    }

    echo "<script>alert('Invalid Email/Password!');window.location='login.php'</script>";


}else{
    header('Location:login.php');
}
?>