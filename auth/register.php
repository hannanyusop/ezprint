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
        <form class="register-form" action="verify-signup.php" method="post">
            <p>Create New Account</p>
            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address"/>
            <button type="submit" name="register">Create Account</button>
            <p class="message">Already registered? <a href="login.php">Sign In</a></p>
        </form>
    </div>
</div>
<script type="text/javascript" src="../asset/js/jquery.js"></script>