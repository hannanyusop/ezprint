<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
<?php

    $year = 2019;
    if(isset($_GET['year'])){

        #check if year is in range
        if(in_array($_GET['year'], getYear())){
            $year = $_GET['year'];
        }else{
            echo "<script>alert('Invalid year!');window.location='sale-report.php'</script>";
        }
    }
    $reject = $done = $income = array();
    foreach (getStrMonth() as $key => $month){

        $query = $db->query("SELECT SUM(total_price) as total,COUNT(*) as count FROM jobs WHERE status=3 AND YEAR(created_at)=$year AND MONTH(created_at)=$key");
        $result = $query->fetch_assoc();

        $r = $db->query("SELECT SUM(total_price) as total,COUNT(*) as count FROM jobs WHERE status=4 AND YEAR(created_at)=$year AND MONTH(created_at)=$key");
        $reject_re = $r->fetch_assoc();


        $total = (!is_null($result['total']))? $result['total'] : 0;

        array_push($done, (int)$result['count']);
        array_push($reject, (int)$reject_re['count']);
        array_push($income, $total);

    }

    $done = json_encode($done); $reject = json_encode($reject);
    $income = json_encode($income); $labels = json_encode(array_values(getStrMonth()));
//    var_dump($result);exit();
?>
<body>
<div id="layout">
    <?php include_once('layout/aside.php'); ?>
    <div id="main">
        <div class="header">
            <h1>SALE REPORT</h1>
            <h2>ANNUAL REPORT <?= $year; ?></h2>
        </div>

        <div class="content">
            <div>
                <form class="pure-form" method="get">
                    <fieldset>
                        <select name="year">
                            <?php foreach (getYear() as $y): ?>
                                <option value="<?= $y ?>" <?= (isset($_GET['year']))? ($_GET['year'] == $y)? 'SELECTED' : '' : '' ?>><?= $y ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="pure-button pure-button-primary">Generate</button>
                    </fieldset>
                </form>

                <h3>By Total Sale</h3>
                <canvas id="myChart"></canvas>

                <h3>By Total Job Done</h3>
                <canvas id="count"></canvas>

            </div>
        </div>
    </div>
</div>
<?php include_once('layout/footer.php'); ?>
</body>
<script src="../../asset/js/chart.js"></script>
<script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        data: {
            labels: <?= $labels ?>,
            datasets: [{
                label: 'Income RM', borderColor: 'rgb(255,163,21)', backgroundColor: 'rgb(255,163,21)', data: <?= $income; ?>
            }],
        },

        // Configuration options go here
        options: {
            scales: {
                xAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    },
                    ticks: {
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return 'RM ' + value.toFixed(2);
                        }
                    }
                }]
            }
        }
    });

    var count = document.getElementById('count').getContext('2d');
    var x = new Chart(count, {
        // The type of chart we want to create
        type: 'line',
        labelString: 'Testing',

        data: {
            labels: <?= $labels ?>,
            datasets: [
                {label: 'Rejected', borderColor: 'rgb(255, 99, 132)',backgroundColor: 'rgb(255, 99, 132)',data: <?= $reject ?>},
                {label: 'Completed', borderColor: 'rgb(70,133,255)', backgroundColor: 'rgb(70,133,255)', data: <?= $done ?>}
                ]
        },

        // Configuration options go here
        options: {
            scales: {
                xAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    },
                    ticks: {
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return parseInt(value);
                        }
                    }
                }],
            }
        }
    });
</script>
</html>
