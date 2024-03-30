
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Category</title>
</head>

<body>
    <div class="container">
        <h1 style="font-weight: 600; opacity: .8;">Category</h1>
    </div>
    <div class="container mt-3">
        <?php
        if (isset($_SESSION['category-inserted'])) {
            ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['category-inserted'];
                unset($_SESSION['category-inserted']);
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        } else if (isset($_SESSION['category-deleted'])) {
            ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['category-deleted'];
                    unset($_SESSION['category-deleted']);
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
        }
        else if (isset($_SESSION['category-updated'])) {
            ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['category-updated'];
                    unset($_SESSION['category-updated']);
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
                <!-- <input type="search" name="searchForm" id="searchForm" class="form-control" placeholder="Search..." style="border: 1px solid cadetblue;"> -->
            </div>
            <div class="col-xl-4">
                <a href="index.php?pageCategoryAdd=categoryAdd" class="btn btn-success float-right"><i class="fa-solid fa-plus"></i> Add new</a>
                <button type="button" class="btn btn-info float-right text-white mr-2" onclick="printTable()"><i class="fa-solid fa-print"></i> Print</button>
                <button type="button" class="btn btn-danger float-right mr-2" data-bs-toggle="modal"
                    data-bs-target="#deleteModal">
                    <i class="fa-solid fa-trash"></i>
                    Delete all
                </button>
                <!-- Modal Popup Delete -->
                <div class="modal fade" id="deleteModal" tabindex="-1"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                <a href="index.php?pageCategoryDelete=categoryDelete&&action=Delete"
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
                    <th>ID</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $c = new Category();
                $cate = $c->getAllCategory();
                foreach($cate as $data){
                        ?>
                        <tr>
                            <td>
                                <?php echo $data['id']; ?>
                            </td>
                            <td>
                                <?php echo $data['category_name']; ?>
                            </td>
                            <td>
                                <?php echo $data['descriptions']; ?>
                            </td>
                            <td>
                                <a href="index.php?pageCategoryUpdate=categoryUpdate&&id=<?php echo $data['id']; ?>&&action=Update"
                                    class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal<?php echo $data['id']; ?>">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <!-- Modal Popup Delete -->
                                <div class="modal fade" id="deleteModal<?php echo $data['id']; ?>" tabindex="-1"
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
                                                <a href="index.php?pageCategoryDelete=categoryDelete&&id=<?php echo $data['id']; ?>"
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
                    url: "./user/adminSearch.php",
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