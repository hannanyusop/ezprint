<?php
    include_once('../permission_staff.php');

    if(isset($_GET['id'])){

        $result = $db->query("SELECT * FROM jobs WHERE id=$_GET[id] AND status=1");

        $job = $result->fetch_assoc();

        if(!$job){
            echo "<script>alert('Job not found!');window.location='dashboard.php'</script>";
        }

        #add on list
        $job_result = $db->query("SELECT * FROM jobs_has_add_on as a LEFT JOIN add_on as b ON a.add_on_id=b.id WHERE job_id=$job[id]");

        #update job status
        $update_job = "UPDATE jobs SET status=2, staff_id=$user_id WHERE id=$job[id]";

        if (!$db->query($update_job)) {
            echo "Error: " . $update_job . "<br>" . $db->error; exit();
        }

        echo "<script>alert('Successfully!');window.location='job-view.php?id=".$job[id]."'</script>";

    }else{
        echo "<script>alert('Invalid action!');window.location='dashboard.php'</script>";
    }
?>