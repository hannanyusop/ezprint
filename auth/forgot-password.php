<link rel="stylesheet" type="text/css" href="../asset/css/login.css">
<?php

require_once '../env.php';

if(isset($_GET['key'])){


    #check if key is exist
    $user_q = $db->query("SELECT * FROM users WHERE reset_password_key='$_GET[key]'");
    $user = $user_q->fetch_assoc();


    if(!$user){
        echo "<script>alert('Invalid Key!');window.location='forgot-password-request.php'</script>";
    }

    if(isset($_POST['reset'])){

        $hash_pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
        if (!$db->query("UPDATE users SET password='$hash_pass',reset_password_key=null WHERE id='$user[id]'")) {
            echo "Error: Inserting user data." . $db->error; exit();
        }else{

            echo "<script>alert('Password successfully recovered!');window.location='login.php '</script>";
        }

    }

}else{

    echo "<script>alert('Invalid URL');window.location='forgot-password-request.php '</script>";
}

?>
<head>
    <title>ezPrint by Hannan</title>
    <meta charset="UTF-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="John Doe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<div class="login-page">
    <div class="form">
        <form class="login-form" method="post">
            <img src="../asset/image/logo.png" height="85">
            <p>Recover Password</p>
            <input type="email" name="email" placeholder="email" value="<?= $user['email'] ?>" disabled>
            <input type="password" name="password" id="password" placeholder="New Password" required>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
            <span id="message"></span>
            <button type="submit" name="reset">Change Password</button>
            <p class="message">Already Remember? <a href="login.php">Login</a></p>
        </form>
    </div>
</div>
<script type="text/javascript" src="../asset/js/jquery.js"></script>
<script type="text/javascript">

    $('#password, #confirm_password').on('keyup', function () {

        if($('#confirm_password').val() != '' || $('#password').val() != ''){

            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else {
                $('#message').html('Password Not Matching').css('color', 'red');

            }
        }

    });
</script>


