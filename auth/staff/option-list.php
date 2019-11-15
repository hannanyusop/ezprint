<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
<?php include_once('layout/aside.php') ?>

<?php

    $add_ons = $db->query("SELECT * FROM add_on");

    if(isset($_GET['enabled'])){
        $disabled_q = $db->query("SELECT * FROM add_on WHERE id=$_GET[enabled] and is_active = 0");
        $disabled = $disabled_q->fetch_assoc();

        if(!$disabled){
            echo "<script>alert('Invalid Data!');window.location='option-list.php'</script>";
        }

        if (!$db->query("UPDATE add_on SET is_active = 1 WHERE id=$_GET[enabled]")) {
            echo "Error: Updating add-on status." . $db->error; exit();
        }else{
            echo "<script>alert('Add-on #$_GET[enabled] has been enabled!');window.location='option-list.php'</script>";
        }
    }elseif(isset($_GET['disabled'])){
        $disabled_q = $db->query("SELECT * FROM add_on WHERE id=$_GET[disabled] and is_active = 1");
        $disabled = $disabled_q->fetch_assoc();

        if(!$disabled){
            echo "<script>alert('Invalid Data!');window.location='option-list.php'</script>";
        }

        if (!$db->query("UPDATE add_on SET is_active = 0 WHERE id=$_GET[disabled]")) {
            echo "Error: Updating add-on status." . $db->error; exit();
        }else{
            echo "<script>alert('Add-on #$_GET[disabled] has been disabled!');window.location='option-list.php'</script>";
        }
    }

    if(isset($_POST['submit'])){

        foreach ($_POST['option'] as $name => $value){

            $option_q = $GLOBALS['db']->query("SELECT * FROM options WHERE name='$name'");
            $option = $option_q->fetch_assoc();

            if($option){

                #validate value before update data
                if(!is_numeric($value)){
                    echo "<script>alert('Invalid value for $name!');window.location='option-list.php'</script>"; exit();
                }

                if (!$db->query("UPDATE options SET value = '$value' WHERE name='$name'")) {
                    echo "Error: Updating  option value!." . $db->error; exit();
                }
            }
        }

        echo "<script>alert('All Pricing has been updated!');window.location='option-list.php'</script>";

    }
?>



<main role="main">

    <section class="panel">
        <h2>Pricing</h2>
        <form method="post">
            <div class="twothirds">
                <label for="black_and_white_price">Black & White(Monochrome) Price</label>
                <input type="text" name="option[price_black_and_white]" value="<?= getOption('price_black_and_white', 0.20) ?>" placeholder="Full Name" />

                <label for="black_and_white_price">Colour Price</label>
                <input type="text" name="option[price_colour]" value="<?= getOption('price_colour', 0.20) ?>" placeholder="Full Name" />

                <button type="submit" name="submit" class="btn btn-md btn-info">Search</button>
            </div>
        </form>
    </section>

    <section class="panel">
        <h2>Add On</h2>
        <div class="content">
            <a class="btn btn-md btn-success float-right" href="option-add-on-add.php">Insert New Add-on</a>

            <table>
                <tr>
                    <th>NAME</th>
                    <th>DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
                <?php if($add_ons->num_rows > 0){ while($add_on = $add_ons->fetch_assoc()){ ;?>
                    <tr>
                        <td><?= $add_on['name']; ?></td>
                        <td><?= $add_on['description']; ?></td>
                        <td class="font-weight-bold text-success"><?= displayPrice($add_on['price']); ?></td>
                        <td><?= getAddOnStatus($add_on['is_active']) ?></td>
                        <td>
                            <a href="option-add-on-edit.php?id=<?= $add_on['id']; ?>" class="font-weight-bold text-info">Edit</a> |

                            <?php if($add_on['is_active'] == 0) { ?>
                                <a onclick="return confirm('Are you sure to enabled this add-on?')" href="option-list.php?enabled=<?= $add_on['id']; ?>" class="font-weight-bold text-success"><i class="fa fa-check"></i> Activate</a>
                            <?php }else{ ?>
                                <a onclick="return confirm('Are you sure to disabled this add-on?')" href="option-list.php?disabled=<?= $add_on['id']; ?>" class="font-weight-bold text-danger"><i class="fa fa-times"></i> Disabled</a>
                            <?php } ?>
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