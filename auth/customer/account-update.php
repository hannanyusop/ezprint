<html lang="en">
<?php include_once('../permission_customer.php') ?>
<?php include_once('layout/header.php') ?>
<?php

    if(isset($_POST['submit'])){


        $check_q = $db->query("SELECT * FROM users WHERE email='$_POST[email]' AND id <> $user_id");
        $check = $check_q->fetch_assoc();

        if($check){
            echo "<script>alert('Email already exist!');window.location='account-update.php'</script>";
        }


        if (!$db->query("UPDATE users SET  email = '$_POST[email]' WHERE id=$user_id")) {
            echo "Error: Inserting user data." . $db->error; exit();
        }else{

            #add customer account
            echo "<script>alert('Customer information updated!');window.location='account-update.php'</script>";
        }

    }elseif (isset($_POST['reset_password'])){


        if(password_verify($_POST['password'], $user['password'])){

            $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

            if (!$db->query("UPDATE users SET password='$new_password' WHERE id=$user_id")) {
                echo "Error: Updating customer password." . $db->error; exit();
            }else{
                echo "<script>alert('Password Updated!');window.location='account-update.php'</script>";
            }

        }else{
            echo "<script>alert('Old password not match!');window.location='account-update.php'</script>";
        }

    }

?>
<?php include_once('layout/aside.php') ?>

<main role="main">
    <div class="offset-3">
        <section class="panel">
            <div class="content">
                <h2>Update Information</h2>

                <form method="post">

                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" placeholder="Email" value="<?= $user['email']; ?>">

                    <label for="full_name">Full Name:</label>
                    <input type="text" name="full_name" id="full_name" placeholder="Full Name" value="<?= $user['fullname']; ?>" disabled>
                    <small class="text-info text-sm">To change your name, please directly call our customer service.</small>

                    <div class="m-2">
                        <input class="btn btn-md btn-success" name="submit" type="submit" value="Update Email" />
                    </div>
                </form>
            </div>


            <div class="content">
                <h2>Reset Password</h2>
                <form method="post">
                    <div class="form-group">
                        <input type="password" name="password" id="password" placeholder="Old Password" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="new_password" id="new_password"  placeholder="New Password" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                        <span class="text-sm text-danger" id="message"></span>
                    </div>

                    <div>
                        <button class="btn btn-md btn-warning" name="reset_password" id="reset_password" type="submit">Change Password</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>>

<?php include_once('layout/footer.php') ?>
</html>
<script type="text/javascript" src="../../asset/js/jquery.js"></script>
<script type="text/javascript">

    $('#password, #confirm_password').on('keyup', function () {

        if($('#confirm_password').val() != '' || $('#new_password').val() != ''){

            if ($('#new_password').val() == $('#confirm_password').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else {
                $('#message').html('Password Not Matching').css('color', 'red');

            }
        }

    });
</script>