<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_manager.php') ?>
<?php include_once('layout/aside.php') ?>
<?php
    if(isset($_GET['id'])){

        $add_on_q = $db->query("SELECT * FROM add_on WHERE id=$_GET[id]");
        $add_on = $add_on_q->fetch_assoc();

        if(!$add_on){
            echo "<script>alert('Add on not exist!');window.location='option-list.php'</script>";
        }

        if(isset($_POST['submit'])){


            $check_q = $db->query("SELECT * FROM add_on WHERE name='$_POST[name]' AND id <> $_GET[id]");
            $check = $check_q->fetch_assoc();

            if($check){
                echo "<script>alert('Name already exist!');window.location='option-add-on-edit.php?id=$_GET[id]'</script>";
            }

            if(!is_numeric($_POST['price'])){
                echo "<script>alert('Invalid value for price!');window.location='option-add-on-edit.php?id=$_GET[id]'</script>";
            }

            $name = strtoupper($_POST['name']);

            $is_active = (isset($_POST['is_active']))? 1 : 0;

            if (!$db->query("UPDATE add_on SET name='$name',is_active = $is_active, description = '$_POST[description]', price = $_POST[price] WHERE id=$_GET[id]")) {
                echo "Error: Updating add on data." . $db->error; exit();
            }else{
                echo "<script>alert('Add on updated!');window.location='option-list.php'</script>";
            }

        }
    }else{
        echo "<script>alert('Error : missing parameter!');window.location='option-list.php'</script>";
    }
?>

<main role="main">
    <div class="offset-3">
        <section class="panel">
            <h2>Edit Add On</h2>
            <form method="post">
                <div class="twothirds">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="<?= $add_on['name'] ?>" placeholder="Name" />

                    <label for="price">Price:</label>
                    <input type="text" name="price" id="price" value="<?= $add_on['price'] ?>" placeholder="Price" />

                    <label for="description">Description:</label>
                    <textarea name="description" id="description" rows="5"><?= $add_on['description'] ?></textarea>

                    <label for="checkbox">
                        <input type="checkbox" name="is_active" id="checkbox" <?= ($add_on['is_active'] == 1)? 'checked' : '' ?>> Enabled
                    </label>
                    <div>
                        <input class="btn btn-md btn-success" name="submit" type="submit" value="Submit" />
                    </div>

                </div>
            </form>
        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
</html>