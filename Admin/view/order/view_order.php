<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Order</title>
</head>
<style>
    #viewIMG{
        transition: .3s;
    }
    #viewIMG:hover{
        transform: scale(10.5);
    }
</style>

<body>
    <div class="container mt-3">
        <h1 style="font-weight: 600; opacity: .8;">Order settings</h1>
        <?php
        if (isset($_GET['get_order_id'])) {
            $get_order_id = $_GET['get_order_id'];
            if (isset($_POST['update_status'])) {
                $get_status_id = $_POST['choose_order_status'];
                $_SESSION['status-id'] = $get_status_id;
                $update_status = new Order();
                // var_dump($get_order_id);
                $update_status->update_order_status_by_id($get_order_id, $get_status_id);
            }
        }
        ?>
    </div>
    <div class="container mt-3">
       <?php
        if (isset($_SESSION['order-deleted'])) {
            ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['order-deleted'];
                    unset($_SESSION['order-deleted']);
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
        }
        else if (isset($_SESSION['order-updated'])) {
            ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['order-updated'];
                    unset($_SESSION['order-updated']);
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
        }
        ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <input type="search" name="searchForm" id="searchForm" class="form-control" placeholder="Search..."
                    style="border: 1px solid cadetblue;">
            </div>
            <div class="col-xl-8">
                <button type="button" class="btn btn-info float-right text-white mr-2" onclick="printTable()"><i
                        class="fa-solid fa-print"></i> Print</button>
                <button type="button" class="btn btn-danger float-right mr-2" data-bs-toggle="modal"
                    data-bs-target="#deleteModal">
                    <i class="fa-solid fa-trash"></i>
                    Delete all
                </button>
                <!-- Modal Popup Delete -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fs-5" id="deleteModalLabel">Delete</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure, you want to delete all here?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a href="index.php?pageDeleteOrder=deleteOrder&&action=Delete"
                                    class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="result" class="container mt-4">

    </div>
    <div id="dataTable" class="container mt-4">
        <table id="example" class="table table-hover table-striped table-responsive-sm">
            <thead>
                <tr>
                    <th>OrderID</th>
                    <th>UserID</th>
                    <th>Shop</th>
                    <th>ProductID</th>
                    <th>Amount</th>
                    <th>Amount</th>
                    <th>Payment_invoice</th>
                    <th>Location</th>
                    <th>Order Status</th>
                    <th>Order Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $order = new Order();
                $order_info = $order->get_all_order();

                foreach ($order_info as $data) {
                    $id = $data['orders'];
                    ?>
                    <tr>
                        <td>
                        <?php echo $data['orders']; ?>
                        </td>
                        <td>
                            <?php echo $data['names'] ?>
                        </td>
                        <td>
                            <?php echo $data['shop_name']; ?>
                        </td>
                        <td>
                            <?php echo $data['product_name']; ?>
                        </td>
                        <td>
                            <?php echo $data['amount']; ?>
                        </td>
                        <td>
                            <?php echo $data['size']; ?>
                        </td>
                        <td>
                        <img src="../../Front-end/assets/img/<?php echo $data['payment_invoice'];?>" id="viewIMG" alt="" height="50">
                        </td>
                        <td>
                            <?php echo $data['location']; ?>
                        </td>
                        <td>

                            <form action="index.php?pageOrder=order&&get_order_id=<?php echo $data['orders']; ?>" method="post">
                                <select class="form-select" style="width: 120px" name="choose_order_status"
                                    aria-label="Default select example">
                                    <?php
                                        $sql = "select `order_status_id` from `orders` where `id` = $id";
                                        $exe = $con->query($sql);
                                        if($exe->num_rows > 0){
                                            while($res = $exe->fetch_assoc()){
                                                $status = $res['order_status_id'];
                                                if($status == 1){
                                                    ?>
                                                        <option value="1">Completed</option>
                                                        <option value="2">Pending</option>
                                                        <option value="3">Cancelled</option>
                                                    <?php 
                                                }
                                                else if($status == 2){
                                                    ?>
                                                        <option value="2">Pending</option>
                                                        <option value="1">Completed</option>
                                                        <option value="3">Cancelled</option>
                                                    <?php 
                                                }
                                                else if($status == 3){
                                                        ?>
                                                            <option value="3">Cancelled</option>
                                                            <option value="1">Completed</option>
                                                            <option value="2">Pending</option>
                                                        <?php 
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <button type="submit" name="update_status" class="btn btn-outline-dark mt-3"
                                    style="width: 150px">Update</button>
                            </form>
                        </td>
                        <td>
                            <?php echo $data['order_time'] ?>
                        </td>
                        <td>
                            <a href="index.php?pageUpdateOrder=orderUpdate&&id=<?php echo $data['orders']; ?>&&action=Update"
                                class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal<?php echo $data['orders']; ?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <!-- Modal Popup Delete -->
                            <div class="modal fade" id="deleteModal<?php echo $data['orders']; ?>" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="deleteModalLabel">Delete</h5>
                                            <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure, You want to delete this?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <a href="index.php?pageDeleteOrder=deleteOrder&&id=<?php echo $data['orders']; ?>"
                                                class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
<script>
    $(document).ready(function () {
        $("#searchForm").on("keyup", function () {
            $("#dataTable").css("display", "none");
            var keyword = $(this).val();
            if (keyword != "") {
                $.ajax({
                    url: "./order/orderSearch.php",
                    method: "post",
                    data: { keyword: keyword },
                    success: function (data) {
                        $("#result").html(data);
                        $("#result").css("display", "block");
                    }
                });
            } else {
                $("#dataTable").css("display", "block");
                $("#result").css("display", "none");
            }
        });
    });
    function printTable() {
        window.print();
    }
</script>

</html>