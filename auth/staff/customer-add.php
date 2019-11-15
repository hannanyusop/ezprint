<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
<?php include_once('layout/aside.php') ?>
<?php
$result = $db->query("SELECT * FROM jobs WHERE status=1");

if(isset($_POST['submit'])){

    #check if email is unique
    if(isset($_POST['email'])){

        $user_q = $db->query("SELECT * FROM users WHERE email='$_POST[email]'");
        $job = $user_q->fetch_assoc();


        if($job){
            echo "<script>alert('Email already exist!');window.location='customer-add.php'</script>";
        }
    }

    $fullname = strtoupper($_POST['full_name']);

    if (!$db->query("INSERT INTO users (role_id, email, password, fullname, is_active, is_confirm, created_at) VALUES (3, '$_POST[email]', 'secret', '$fullname', 1, 1, CURRENT_TIMESTAMP)")) {
        echo "Error: Inserting user data." . $db->error; exit();
    }else{

        #add customer account

        $last_user_id = (int)$db->insert_id;
        if(!$db->query("INSERT INTO accounts (user_id, credit_balance, credit_total, address) VALUES ($last_user_id, 0.00, 0.00, '')")){

            $db->query("DELETE FROM users WHERE id=$last_user_id");
            #delete prev customer
            echo "Error: Inserting user account." . $db->error; exit();
        }
        echo "<script>alert('Customer Created!');</script>";
    }

}
//    var_dump($result);exit();
?>

<main role="main">
    <div class="offset-3">
        <section class="panel">
            <h2>Add customer</h2>
            <form method="post" action="customer-add.php">
                <div class="twothirds">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" placeholder="Email" required>

                    <label for="full_name">Full Name:</label>
                    <input type="text" name="full_name" id="full_name" placeholder="Full Name" required>

                    <label for="password">Password:</label>
                    <input type="text" name="password" id="password" value="secret" disabled/>

                    <div>
                        <label for="checkbox">
                            <input type="checkbox" name="activate_account" id="checkbox" /> Activate Account
                        </label>
                        <label for="checkbox">
                            <input type="checkbox" name="invite_email" id="checkbox" /> Send invitation via email
                        </label>
                    </div>

                    <div>
                        <input class="btn btn-md btn-success" name="submit" type="submit" value="Submit" />
                        <a class="btn btn-md btn-warning" href="customer-list.php">Back</a>
                    </div>

                </div>
            </form>
        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
</html>