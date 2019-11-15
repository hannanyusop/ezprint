<nav role="navigation">
    <ul class="main">
        <li class="dashboard"><a href="dashboard.php">Dashboard</a></li>
        <li class="write"><a href="job-list.php">My Task</a></li>
        <li class="edit"><a href="customer-list.php">Customer List</a></li>

        <?php if($_SESSION['auth']['role'] == 1){ ?>
        <li class="users"><a href="sale-report.php">Sale Report</a></li>
        <li class="users"><a href="staff-list.php">Manage Staff</a></li>
        <li class="users"><a href="option-list.php">Manage Add On & Pricing</a></li>
        <?php } ?>
        <li class="logout"><a href="../logout.php">Logout</a></li>
    </ul>
</nav>