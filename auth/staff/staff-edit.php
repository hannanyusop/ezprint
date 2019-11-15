<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_manager.php') ?>
<?php include_once('layout/aside.php') ?>
<?php

if(isset($_GET['id'])){

    $staff_q = $db->query("SELECT * FROM users WHERE id=$_GET[id] AND role_id IN(1,2)");
    $staff = $staff_q->fetch_assoc();

    if(!$staff){
        echo "<script>alert('Staff not exist!');window.location='staff-list.php'</script>";
    }

    if(isset($_POST['submit'])){


        $check_q = $db->query("SELECT * FROM users WHERE email='$_POST[email]' AND id <> $_GET[id]");
        $check = $check_q->fetch_assoc();

        if($check){
            echo "<script>alert('Email already exist!');window.location='staff-edit.php?id=$_GET[id]'</script>";
        }

        $fullname = strtoupper($_POST['full_name']);

        $role_id = (isset($_POST['manager']))? 1 : 2;

        if (!$db->query("UPDATE users SET fullname='$fullname', email = '$_POST[email]',role_id = $role_id WHERE id=$_GET[id]")) {
            echo "Error: Inserting user data." . $db->error; exit();
        }else{

            #add customer account
            echo "<script>alert('Staff information updated!');window.location='staff-list.php'</script>";
        }

    }elseif (isset($_POST['reset_password'])){

        $default_password = password_hash("secret", PASSWORD_BCRYPT);

        if (!$db->query("UPDATE users SET password='$default_password' WHERE id=$_GET[id]")) {
            echo "Error: Updating staff password." . $db->error; exit();
        }else{

            #add customer account
            echo "<script>alert('Staff password has been reset!');window.location='staff-list.php'</script>";
        }
    }
}else{
    echo "<script>alert('Error : missing parameter!');window.location='staff-list.php'</script>";
}
?>

<main role="main">
    <div class="offset-3">
        <section class="panel">
            <div class="twothirds">
                <h2>Update Information</h2>

                <form method="post">

                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" placeholder="Email" value="<?= $staff['email']; ?>">

                    <label for="full_name">Full Name:</label>
                    <input type="text" name="full_name" id="full_name" placeholder="Full Name" value="<?= $staff['fullname']; ?>">

                    <div>
                        <label for="checkbox">
                            <input type="checkbox" name="manager" <?= ($staff['role_id'] == 1)? 'checked' : '' ?>> Set as Manager
                        </label>
                    </div>

                    <div>
                        <input class="btn btn-md btn-success" name="submit" type="submit" value="Update user Information    " />
                    </div>
                </form>
            </div>


            <div class="twothirds">
                <h2>Reset Password</h2>
                <form method="post">
                        <label for="password">Password:</label>
                        <input type="text" name="password" id="password" placeholder="Email" value="secret" readonly>

                        <div>
                            <input onclick="return confirm('Are you sure want to reset password for this user?')" class="btn btn-md btn-warning" name="reset_password" type="submit" value="Reset user password" />
                        </div>
                </form>
            </div>
            <a class="btn btn-md btn-warning" href="staff-list.php">Back</a>

        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
</html>