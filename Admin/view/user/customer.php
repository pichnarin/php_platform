
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <title>Customer</title>
</head>

<body>
    <div class="container">
        <h1 style="font-weight: 600; opacity: .8;">Customers</h1>
    </div>
    <div class="container  mt-3">
        <?php
        if (isset($_SESSION['msg-success'])) {
            ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['msg-success'];
                unset($_SESSION['msg-success']);
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        } else if (isset($_SESSION['msg-deleted'])) {
            ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['msg-deleted'];
                    unset($_SESSION['msg-deleted']);
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
        }
        else if (isset($_SESSION['msg-updated'])) {
            ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['msg-updated'];
                    unset($_SESSION['msg-updated']);
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
                <input type="search" name="searchForm" id="searchForm" class="form-control" placeholder="Search..." style="border: 1px solid cadetblue;">
            </div>
            <div class="col-xl-8">
                <a href="index.php?pageCustomerAdd=customerAdd" class="btn btn-success float-right"><i class="fa-solid fa-plus"></i> Add new</a>
                <button type="button" class="btn btn-info float-right text-white mr-2" onclick="printTable('dataTable' , 'html')"><i class="fa-solid fa-print"></i> Print</button>
            </div>
        </div>
    </div>
    <div id="result" class="container mt-4">

    </div>
    <div id="dataTable" class="container mt-4">
        <table id="example" class="table table-hover table-striped table-responsive-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Profile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $c = new User();
                $cus = $c->getUserCustomer();
                foreach($cus as $data){
                        ?>
                        <tr>
                            <td>
                                <?php echo $data['customer_id']; ?>
                            </td>
                            <td>
                                <?php echo $data['firstname']; ?>
                            </td>
                            <td>
                                <?php echo $data['lastname']; ?>
                            </td>
                            <td>
                                <?php echo $data['phoneNumber']; ?>
                            </td>
                            <td>
                                <?php echo $data['email']; ?>
                            </td>
                            <td>
                                <img src="../Upload/<?php echo $data['profile']; ?>" alt="" class="rounded-circle"
                                    height="40" width="40">
                            </td>
                            <td>
                                <a href="index.php?pageCustomerUpdate=customerUpdate&&id=<?php echo $data['customer_id']; ?>&&action=Update"
                                    class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal<?php echo $data['customer_id']; ?>">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <!-- Modal Popup Delete -->
                                <div class="modal fade" id="deleteModal<?php echo $data['customer_id']; ?>" tabindex="-1"
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
                                                <a href="index.php?pageCustomerDelete=customerDelete&&id=<?php echo $data['customer_id']; ?>"
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
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<script>
    $(document).ready(function(){
        $("#searchForm").on("keyup" , function(){
            $("#dataTable").css("display" , "none");
            var keyword = $(this).val();
            if(keyword != ""){
                $.ajax({
                    url: "./user/customerSearch.php",
                    method: "post",
                    data: {keyword: keyword},
                    success: function(data){
                        $("#result").html(data);
                        $("#result").css("display" , "block");
                    }
                });
            }else{
                $("#dataTable").css("display" , "block");
                $("#result").css("display" , "none");
            }
        });
    });
    function printTable() {
        window.print();
    }
</script>
</html>