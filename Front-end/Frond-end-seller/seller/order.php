<?php
include('header.php');

?>
<div class="wrapper">
    <!-- side bar -->
    <?php
    include('sidebar.php');
    ?>

    <div class="main">
        <!-- slider for the side bar -->
        <?php
        include('sidebarSlider.php');
        ?>
        <main class="content px-3 py-2">
            <div class="container-fluid">
                <div class="row">
                    <!--Total earning  -->
                    <!-- Table element -->
                    <div class="card-custom border-o">
                    <div id="sessionMessage"></div>
                        <div class="card-header">
                            
                            <h5 class="card-title">
                                Order table
                            </h5>
                            <h6 class="card-subtitle ">
                                management of orders from customer
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border border-dark rounded p-3 mb-3">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Invoice</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- the query is at backend -->
                                        <?php echo $tableRows; ?>
                                    </tbody>
                                </table>

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