<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <title>Logo</title>
</head>

<body>
    <div class="container">
        <h1 style="font-weight: 600; opacity: .8;">Menu</h1>
    </div>
    <div class="container mt-3">
        <?php
        if (isset($_SESSION['menu-inserted'])) {
            ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['menu-inserted'];
                unset($_SESSION['menu-inserted']);
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        } else if (isset($_SESSION['menu-updated'])) {
            ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['menu-updated'];
                    unset($_SESSION['menu-updated']);
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
        } else if (isset($_SESSION['menu-deleted'])) {
            ?>
                    <div class="alert alert-success">
                    <?php
                    echo $_SESSION['menu-deleted'];
                    unset($_SESSION['menu-deleted']);
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
                <!-- <input type="search" name="searchForm" id="searchForm" class="form-control" placeholder="Search..."
                    style="border: 1px solid cadetblue;"> -->
            </div>
            <div class="col-xl-8">
                <a href="index.php?pageMenuAdd=menuAdd" class="btn btn-success float-right"><i
                        class="fa-solid fa-plus"></i> Add new</a>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <table id="example" class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Menu</th>
                    <th>Order_Menu</th>
                    <th>Status</th>
                    <th>Menu_url</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $m = new Menu();
                $result = $m->getAllMenu();
                foreach ($result as $res) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $res['id']; ?>
                        </td>
                        <td>
                            <?php echo $res['title']; ?>
                        </td>
                        <td>
                            <?php echo $res['order_menu']; ?>
                        </td>
                        <td>
                            <?php
                            if ($res['status'] == 'Active') {
                                ?>
                                <div class="btn btn-sm btn-outline-success">
                                    <?php echo $res['status']; ?>
                                </div>
                            <?php
                            } else {
                                ?>
                                <div class="btn btn-sm btn-outline-danger">
                                    <?php echo $res['status']; ?>
                                </div>
                            <?php
                            }
                            ?>
                        </td>
                        <!-- <td>
                            <?php echo $res['category_name'] ?>
                        </td> -->
                        <td><?php echo $res['menu_url'];?></td>
                        <td>
                            <a href="index.php?pageMenuUpdate=menuUpdate&&id=<?php echo $res['id']; ?>&&action=Update"
                                class="btn btn-primary text-white"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal<?php echo $res['id']; ?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <!-- Modal Popup Delete -->
                            <div class="modal fade" id="deleteModal<?php echo $res['id']; ?>" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="deleteModalLabel">Delete</h5>
                                            <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure, you want to delete this?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <a href="index.php?pageMenuDelete=menuDelete&&id=<?php echo $res['id']; ?>"
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
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
</html>