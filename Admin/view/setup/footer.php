<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <title>Setup Footer</title>
</head>

<body>
    <div class="container">
        <h1 style="font-weight: 600; opacity: .8;">Footer</h1>
    </div>
    <div class="container mt-3">
        <?php
        if (isset($_SESSION['footer-inserted'])) {
            ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['footer-inserted'];
                unset($_SESSION['footer-inserted']);
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        } else if (isset($_SESSION['footer-updated'])) {
            ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['footer-updated'];
                    unset($_SESSION['footer-updated']);
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
        } else if (isset($_SESSION['footer-deleted'])) {
            ?>
                    <div class="alert alert-success">
                    <?php
                    echo $_SESSION['footer-deleted'];
                    unset($_SESSION['footer-deleted']);
                    ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            <?php
        }
        else if (isset($_SESSION['allFooter-deleted'])) {
            ?>
                    <div class="alert alert-success">
                    <?php
                    echo $_SESSION['allFooter-deleted'];
                    unset($_SESSION['allFooter-inserted']);
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
        <div class="col-xl-12">
                <a href="index.php?pageFooterAdd=footerAdd" class="btn btn-success float-right"><i
                        class="fa-solid fa-plus"></i> Add new</a>
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
                                <a href="index.php?pageFooterDelete=footerDelete&&action=Delete"
                                    class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <table id="example" class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Phone Contact</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Social Icon</th>
                    <th>Social Url</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $f = new Footer();
                $result = $f->getAllFooter();
                foreach ($result as $res) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $res['id']; ?>
                        </td>
                        <td>
                            <?php echo $res['email']; ?>
                        </td>
                        <td>
                            <?php echo $res['phone']; ?>
                        </td>
                        <td>
                            <?php echo $res['location']; ?>
                        </td>
                        <td>
                            <?php echo $res['description'] ?>
                        </td>
                        <td>
                            <?php echo $res['icon_social'];?>
                        </td>
                        <td>
                            <?php echo $res['url_social'];?>
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
                            <a href="index.php?pageFooterUpdate=updateFooter&&id=<?php echo $res['id']; ?>&&action=Update"
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
                                            <a href="index.php?pageFooterDelete=menuDelete&&id=<?php echo $res['id']; ?>"
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