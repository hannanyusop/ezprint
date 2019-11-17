<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
<?php include_once('layout/aside.php') ?>
<?php
if(isset($_POST['submit'])){

    if($_POST['email'] == '' || $_POST['name'] != ''){
        echo "<script>alert('Please insert required field!');window.location='customer-add.php'</script>";
    }

    $user_q = $db->query("SELECT * FROM users WHERE email='$_POST[email]'");
    $job = $user_q->fetch_assoc();


    if($job){
        echo "<script>alert('Email already exist!');window.location='customer-add.php'</script>";
    }

    $fullname = strtoupper($_POST['full_name']);

    $default_password = password_hash("secret", PASSWORD_BCRYPT);
    if (!$db->query("INSERT INTO users (role_id, email, password, fullname, is_active, is_confirm, created_at) VALUES (3, '$_POST[email]', '$default_password', '$fullname', 1, 1, CURRENT_TIMESTAMP)")) {
        echo "Error: Inserting user data." . $db->error; exit();
    }else{

        #add customer account

        $last_user_id = (int)$db->insert_id;
        if(!$db->query("INSERT INTO accounts (user_id, credit_balance, credit_total, address) VALUES ($last_user_id, 0.00, 0.00, '')")){

            $db->query("DELETE FROM users WHERE id=$last_user_id");
            #delete prev customer
            echo "Error: Inserting user account." . $db->error; exit();
        }

        $body = "Hye $fullname,<br>
            This email has been registered by admin. Below is your login credential:<br><br>
            E-mail : $_POST[email]<br>
            Password : secret <br>
            Account Balance : RM0.00<br>
            Login Link : <a href='http://$_SERVER[HTTP_HOST]/auth/login.php'>http://$_SERVER[HTTP_HOST]/auth/login.php</a>
            
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

        sendEmail($_POST['email'], 'Welcome to ezPrint', $body);
        echo "<script>alert('Customer Created!');</script>";
    }

}
?>

<main role="main">
    <div class="offset-3">
        <section class="panel">
            <h2>Add customer</h2>
            <form method="post" action="customer-add.php">
                <div class="content">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" placeholder="Email" required>

                    <label for="full_name">Full Name:</label>
                    <input type="text" name="full_name" id="full_name" placeholder="Full Name" required>

                    <label for="password">Password:</label>
                    <input type="text" name="password" id="password" value="secret" disabled/>

                    <div>
                        <label for="checkbox">
                            <input type="checkbox" name="invite_email" id="checkbox" checked disabled> Send invitation via email
                        </label>
                    </div>

                    <div class="float-right content">
                        <button class="btn btn-md btn-success" name="submit" type="submit">Add User</button>
                        <a class="btn btn-md btn-warning" href="customer-list.php">Back</a>
                    </div>

                </div>
            </form>
        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
</html>