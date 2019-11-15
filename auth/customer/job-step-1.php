<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_customer.php') ?>
<?php include_once('layout/aside.php') ?>

<main role="main">
    <div class="offset-3">
        <section class="panel">
            <h2>Add Job Step 1</h2>
            <form action="job-step-2.php" method="post" enctype="multipart/form-data">
                <div class="twothirds">
                    <div>
                        <input type="file" name="file" accept="application/pdf">
                    </div>

                    <div>
                        <input class="btn btn-md btn-success" name="submit" type="submit" value="Next" />
                    </div>

                </div>
            </form>
        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
</html>