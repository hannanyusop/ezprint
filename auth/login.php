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
        <form class="login-form" action="verify.php" method="post">
            <img src="../asset/image/logo.png" height="85">
            <p>Login</p>
            <input type="text" name="email" placeholder="email" required>
            <input type="password" name="password" placeholder="password" required>
            <button>login</button>
            <p class="message">Not registered? <a href="register.php">Create an account</a></p>
            <p class="message">Password missing? <a href="forgot-password-request.php">Recover Now</a></p>
        </form>
    </div>
</div>
<script type="text/javascript" src="../asset/js/jquery.js"></script>