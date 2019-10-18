<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
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
<body>
<div id="layout">
    <?php include_once('layout/aside.php'); ?>
    <div id="main">
        <div class="header">
            <h1>Add Customer</h1>
        </div>


        <div class="content">
            <div>
                <h5>*Note:</h5>

                <form class="pure-form pure-form-aligned" method="post">
                    <fieldset>
                        <div class="pure-control-group">
                            <label for="name">E-mail</label>
                            <input id="email" name="email" type="text" placeholder="E-mail" required>
                        </div>

                        <div class="pure-control-group">
                            <label for="password">Password</label>
                            <input id="password" type="text" placeholder="Password" readonly value="secret" required>
                        </div>

                        <div class="pure-control-group">
                            <label for="full_name">Full Name</label>
                            <input id="full_name" name="full_name" type="text" placeholder="Full Name" required>
                        </div>

                        <div class="pure-control-group">
                            <label for="account_balance">Account Balance</label>
                            <input id="account_balance" type="text" value="RM 0.00" readonly>
                        </div>


                        <div class="pure-controls">

                            <button type="submit" name="submit" class="pure-button pure-button-primary">Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once('layout/footer.php'); ?>
</body>
</html>
