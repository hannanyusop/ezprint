<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_manager.php') ?>
<?php include_once('layout/aside.php') ?>
<?php


        if(isset($_POST['submit'])){


            $check_q = $db->query("SELECT * FROM add_on WHERE name='$_POST[name]'");
            $check = $check_q->fetch_assoc();

            if($check){
                echo "<script>alert('Name already exist!');window.location='option-add-on-add.php'</script>";
            }

            if(!is_numeric($_POST['price'])){
                echo "<script>alert('Invalid value for price!');window.location='option-add-on-add.php'</script>";
            }

            $name = strtoupper($_POST['name']);

            $is_active = (isset($_POST['is_active']))? 1 : 0;

            if (!$db->query("INSERT INTO add_on(name,price,description,is_active) VALUES ('$name', '$_POST[price]', '$_POST[description]', $is_active)")) {
                echo "Error: Inserting add-on data." . $db->error; exit();
            }else{
                echo "<script>alert('Add-on inserted!');window.location='option-list.php'</script>";
            }

        }
?>

<main role="main">
    <div class="offset-3">
        <section class="panel">
            <h2>Insert New Add-on</h2>
            <form method="post">
                <div class="twothirds">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" placeholder="Name" required>

                    <label for="price">Price:</label>
                    <input type="text" name="price" id="price" placeholder="Price" required>

                    <label for="description">Description:</label>
                    <textarea name="description" id="description" rows="5"></textarea>

                    <label for="checkbox">
                        <input type="checkbox" name="is_active" id="checkbox" checked> Enabled
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