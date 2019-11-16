<link rel="stylesheet" type="text/css" href="../asset/css/login.css">
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
            <p>Reset Password</p>
            <input type="email" name="email" placeholder="email" required>
            <button type="submit" name="forgot">Send Code To Email</button>
            <p class="message">Already Remember? <a href="login.php">Login</a></p>
        </form>
    </div>
</div>
<script type="text/javascript" src="../asset/js/jquery.js"></script>
<script type="text/javascript">
    $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });
</script>

<?php

require_once '../env.php';

if(isset($_POST['forgot'])){

    #check if email is unique
    if(isset($_POST['email'])){

        $user_q = $db->query("SELECT * FROM users WHERE email='$_POST[email]'");
        $job = $user_q->fetch_assoc();


        if(!$job){
            echo "<script>alert('Email not exist!');window.location='forgot-password-request.php'</script>";
        }
    }

    $key = generateResetPasswordKey();
    if (!$db->query("UPDATE users SET reset_password_key='$key' WHERE email='$_POST[email]'")) {
        echo "Error: Inserting user data." . $db->error; exit();
    }else{

        $body = "Ops,<br><br>
            <p>You've request to recover password on ".date("m/d/Y h:i:s a", time())." <i>IP ADDRESS: $_SERVER[REMOTE_ADDR]</i><br>
            To recover password please click this <a href='http://$_SERVER[HTTP_HOST]/auth/forgot-password.php?key=$key'>Link</a>.
            If link not working, copy 'http://$_SERVER[HTTP_HOST]/auth/forgot-password.php?key=$key' and paste to your browser's address bar.
             If you not request this, please call Customer Service 06-425635654543 or drop an email at help@ezprint.my</p>
            
            <br><br>
            <small>
                <i>This email was generated automatically by system. Don't reply this email
                    <br>For inquiry please call our Customer Service 06-425635654543</i>
            </small>
            <br><br>
            <small>
                <i>'To give customers the most compelling printing experience possible' <br>- Hannan Yusop (Managing Director & Founder)</i>
                <br>
            </small>";


        sendEmail($_POST['email'], "Recover Password", $body);
        echo "<script>alert('Please check your email.');window.location='login.php '</script>";
    }

}

?>

