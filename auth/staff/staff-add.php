<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_manager.php') ?>
<?php include_once('layout/aside.php') ?>
<?php
if(isset($_POST['submit'])){

    #check if email is unique
    if(isset($_POST['email'])){

        $user_q = $db->query("SELECT * FROM users WHERE email='$_POST[email]'");
        $job = $user_q->fetch_assoc();


        if($job){
            echo "<script>alert('Email already exist!');window.location='staff-add.php'</script>";
        }
    }

    $fullname = strtoupper($_POST['full_name']);

    $role_id = (isset($_POST['manager']))? 1 : 2;

    if (!$db->query("INSERT INTO users (role_id, email, password, fullname, is_active, is_confirm, created_at) VALUES ($role_id, '$_POST[email]', 'secret', '$fullname', 1, 1, CURRENT_TIMESTAMP)")) {
        echo "Error: Inserting user data." . $db->error; exit();
    }else{

        #add customer account
        echo "<script>alert('Staff Created!');window.location='staff-list.php'</script>";
    }

}
//    var_dump($result);exit();
?>

<main role="main">
    <div class="offset-3">
        <section class="panel">
            <h2>Add Staff</h2>
            <form method="post">
                <div class="twothirds">
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" id="email" placeholder="Email" />

                    <label for="full_name">Full Name:</label>
                    <input type="text" name="full_name" id="full_name" placeholder="Full Name" />

                    <label for="password">Password:</label>
                    <input type="text" name="password" id="password" value="secret" disabled/>

                    <div>
                        <label for="checkbox">
                            <input type="checkbox" name="manager" id="checkbox" /> Set as Manager
                        </label>
                    </div>

                    <div>
                        <input class="btn btn-lg btn-success" name="submit" type="submit" value="Submit" />
                    </div>

                </div>
            </form>
        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
</html>