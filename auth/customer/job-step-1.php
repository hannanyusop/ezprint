
<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_customer.php') ?>
<body>
<div id="layout">
    <?php include_once('layout/aside.php'); ?>
    <div id="main">
        <div class="header">
            <h1>Create Printing Job</h1>
            <h2>Step 1</h2>
        </div>

        <div class="content">
            <div>
                <h6><br></h6>
                <form action="job-step-2.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" accept="application/pdf">
                    <button type="submit" class="button-f pure-button">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once('layout/footer.php'); ?>
</body>
</html>
