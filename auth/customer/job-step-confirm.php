<?php

    require_once '../../env.php';

    $user_id = $_SESSION['auth']['user_id'];
    $job = $_SESSION['jobs'][$user_id];

    #inserting job
    $job_sql = "INSERT INTO jobs (customer_id, staff_id, file, status, total_price, pickup_date, created_at) VALUES ($user_id , 0, '$job[file]', 1, $job[subtotal],  CURRENT_TIMESTAMP , CURRENT_TIMESTAMP)";

    if (!$db->query($job_sql)) {
        echo "Error: " . $job_sql . "<br>" . $db->error; exit();
    }

    $job_id = (int)$db->insert_id;

    #inserting job's add on
    foreach ($job['addOn'] as $add_on){
        #insert data to database;
        $add_on_sql = "INSERT INTO jobs_has_add_on(job_id, add_on_id, price) VALUES ($job_id, $add_on[id], $add_on[price])";

        if (!$db->query($add_on_sql)) {
            echo "Error: " . $add_on_sql . "<br>" . $db->error; exit();
        }
    }

    #all query successfully executed without error;
    echo "<script>alert('Job successfully created!');window.location='dashboard.php'</script>";
?>