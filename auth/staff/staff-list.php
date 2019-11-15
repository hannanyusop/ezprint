<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_manager.php') ?>
<?php include_once('layout/aside.php') ?>

<?php

    if(isset($_GET['name']) && isset($_GET['role'])){

        $condition = "email LIKE '%$_GET[name]%'";

        $c_role = "AND role_id  IN(1,2)";

        if($_GET['role'] != ''){
            $c_role = "AND role_id = $_GET[role]";
        }

        $result = $db->query("SELECT * FROM users WHERE $condition $c_role");
    }else{
        $result = $db->query("SELECT * FROM users WHERE role_id  IN(1,2) ");
    }

?>



<main role="main">

    <section class="panel important">
        <h2>Staff</h2>
        <form method="get">
            <div class="onethird">
                <input type="text" name="name" value="<?= (isset($_GET['name']))? $_GET['name'] : '' ?>" placeholder="Full Name / Email" />
            </div>
            <div class="onethird">
                <select name="role">
                    <option value="">MANAGER / STAFF</option>
                    <?php foreach (getBackendRole() as $key => $role){ ?>
                        <option value="<?= $key ?>" <?= (isset($_GET['role']))? ($_GET['role'] == $key)? 'selected' : '' : '' ?>><?= $role; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="onethird mb-2">
                <button type="submit" class="btn btn-md btn-info">Search</button>
                <a class="btn btn-md btn-warning" href="staff-list.php">Reset</a>
                <a class="btn btn-md btn-success" href="staff-add.php">Add Staff</a>

            </div>
        </form>
    </section>

    <section class="panel important">
        <div class="content">
            <table>
                <tr>
                    <th>#</th>
                    <th>E-MAIL</th>
                    <th>FULL NAME</th>
                    <th>ROLE</th>
                    <th>LAST LOGIN</th>
                    <th>LAST IP ADDRESS</th>
                    <th>ACTION</th>
                </tr>
                <?php if($result->num_rows > 0){ while($customer = $result->fetch_assoc()){ ;?>
                    <tr>
                        <td><?= $customer['id']; ?></td>
                        <td><?= $customer['email']; ?></td>
                        <td><?= $customer['fullname'] ?></td>
                        <td><?= getRole($customer['role_id']); ?></td>
                        <td><?= $customer['last_login_at'] ?></td>
                        <td><?= $customer['last_ip_address'] ?></td>
                        <td>
                            <a href="staff-view.php?id=<?= $customer['id']; ?>" class="font-weight-bold text-info">View</a> |
                            <a href="staff-edit.php?id=<?= $customer['id']; ?>" class="font-weight-bold text-success">Edit</a>
                        </td>
                    </tr>
                <?php } }else{ ?>
                    <tr>
                        <td class="text-center" colspan="6">No data</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </section>
</main>

<?php include_once('layout/footer.php') ?>
</html>