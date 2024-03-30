<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logo</title>
</head>

<body>
    <div class="container">
        <h1 style="font-weight: 600; opacity: .8;">Logo</h1>
    </div>
    <div class="container mt-3">
        <?php
        if (isset($_SESSION['logo-inserted'])) {
            ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['logo-inserted'];
                unset($_SESSION['logo-inserted']);
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        } else if (isset($_SESSION['logo-updated'])) {
            ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['logo-updated'];
                    unset($_SESSION['logo-updated']);
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
        } else if (isset($_SESSION['logo-deleted'])) {
            ?>
                    <div class="alert alert-success">
                    <?php
                    echo $_SESSION['logo-deleted'];
                    unset($_SESSION['logo-deleted']);
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
                <a href="index.php?pageLogoAdd=logoAdd" class="btn btn-success float-right"><i
                        class="fa-solid fa-plus"></i> Add new</a>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <table id="example" class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Logo</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $l = new Logo();
                $data = $l->getLogo();
                $path = '../../Front-end/assets/img/';
                foreach ($data as $res) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $res['id']; ?>
                            </td>
                            <td>
                                <img src="<?php echo $path . $res['logo']; ?>" height="50" width="130" alt="">
                            </td>
                            <td>
                                <?php echo $res['description'];?>
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
                        <td>
                            <a href="index.php?pageLogoUpdate=logoUpdate&&id=<?php echo $res['id']; ?>&&action=Update"
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
                                            <a href="index.php?pageLogoDelete=logoDelete&&id=<?php echo $res['id'];?>"
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