<?php
require_once '../../env.php';

if(isset($_POST['colour'])){


    $colour = (int)$_POST['colour'];
    $jobs = $_SESSION['jobs'][1];

    #insert price to session
    $rate = ($colour == 1)? 0.20 : 0.10;
    $price = $jobs['total_page']*$rate;

    $jobs['price'] = $price;
    $jobs['colour'] = ($colour == 1)? "colour" : "black & white";

    #save to session;
    $_SESSION['jobs'][1] = $jobs;

    $result = $db->query("SELECT * FROM add_on WHERE is_active=1");

}else{
    echo "<script>alert('Invalid action');window.location='job-step-1.php'</script>";
}

?>
<h1>Select Add On</h1>

<form action="job-step-4.php" method="post">
    <div id="pricelist">
        <?php if($result->num_rows > 0){ while($add = $result->fetch_assoc()){ ;?>
            <input type="checkbox" name="add-on[]" value="<?= $add['id'] ?>" data-price="<?= $add['price']; ?>"><?= $add['name']."(".displayPrice($add['price']).")" ?><br>
        <?php } }else{ ?>
            <p>No Add On</p>
        <?php } ?>
    </div>

    <br>
    <h3>
        <small>Price : <?= displayPrice($jobs['price']); ?></small><br>
        Subtotal : <span id="subtotal"><?= displayPrice($jobs['price']); ?></span>
    </h3>

    <a href="job-step-2.php">Previous</a>
    <button type="submit">Next</button>
</form>

<script type="text/javascript" src="../../asset/js/jquery.js"></script>
<script>
    function  cal() {
        $('input:checkbox').change(function () {

            var total = <?= (float)$jobs['price'] ?>;
            $('input:checkbox:checked').each(function(){
                total += isNaN(parseInt($(this).val())) ? 0 : parseFloat($(this).data('price'));
            });

            $("#subtotal").text("RM "+parseFloat(total).toFixed(2));
        });
    }

    $('#pricelist :checkbox').click(function(){
        cal();
    });


    cal();

</script>
