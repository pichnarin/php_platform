<?php
// session_start();
include('header.php');
include('orderamountQuery.php');
include('orderByMonth.php');
include('earningByMonth.php');
include('totalOrderEarning.php');
// var_dump($_SESSION['shopID']);
?>
<div class="wrapper">
    <?php
    include('sidebar.php');
    ?>

    <div class="main">
        <div class="row">
            <!-- we need to put slider in every main -->
            <?php include('sidebarSlider.php'); ?>

        </div>


        <main class="content px-3 py-2">
            <div class="container-fluid">
                <div class="mb-3">
                    <h4>Admin Dashboard</h4>
                </div>
                <div class="row">
                    <!-- Total earning -->
                    <div class="col-12 col-md-3 d-flex">
                        <div class="card flex-fill border-0">
                            <div class="card-body py-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h4 class="mb-2">
                                        <?php echo $totalEarnings > 0 ? $totalEarnings . '$' : '0$'; ?>
                                        </h4>
                                        <p class="mb-2">
                                            Total Earnings
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total orders -->
                    <div class="col-12 col-md-3 d-flex">
                        <div class="card flex-fill border-0">
                            <div class="card-body py-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h4 class="mb-2">
                                            <?php echo $totalOrders; ?>
                                        </h4>
                                        <p class="mb-2">
                                            Total Orders
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Display current month's orders and percentage change -->
                    <div class="col-12 col-md-3 d-flex">
                        <div class="card flex-fill border-0">
                            <div class="card-body py-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h4 class="mb-2">
                                            <?php echo $currentMonthOrders; ?>
                                        </h4>
                                        <p class="mb-2">
                                            Current Month's Orders
                                        </p>
                                        <div class="mb-0">
                                            <span class="badge text-<?php echo ($percentageChange > 0) ? 'success' : 'danger'; ?> me-2">
                                                <?php echo round($percentageChange, 2); ?>%
                                            </span>
                                            <span class="text-muted">
                                                from Previous Month
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- current month earning -->
                    <div class="col-12 col-md-3 d-flex">
                        <div class="card flex-fill border-0">
                            <div class="card-body py-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h4 class="mb-2">
                                            <?php echo $currentMonthEarnings; ?>$
                                        </h4>
                                        <p class="mb-2">
                                            Current Month's Earnings
                                        </p>
                                        <div class="mb-0">
                                            <span class="badge text-<?php echo ($percentageChange > 0) ? 'success' : 'danger'; ?> me-2">
                                                <?php echo round($percentageChange, 2); ?>%
                                            </span>
                                            <span class="text-muted">
                                                from Previous Month
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add the sales tracking chart here -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Sales Tracking</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="ordersChart" style="height: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </main>

    </div>

</div>
<?php
include('footer.php');
?>
<script>
    var ctx = document.getElementById('ordersChart').getContext('2d');
    var maxOrders = Math.max.apply(Math, <?php echo json_encode($orders); ?>);
    var suggestedMax = Math.ceil(maxOrders * 1.6);

    var ordersChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($dates); ?>,
            datasets: [{
                label: 'Total Orders',
                data: <?php echo json_encode($orders); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: suggestedMax
                }
            }
        }
    });
</script>