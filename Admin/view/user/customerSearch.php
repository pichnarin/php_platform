<?php
$con = new mysqli('localhost', 'root', '', 'fashion');
?>
    <table class="table table-hover table-striped table-responsive-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Phone Number</th>
                <!-- <th>Address</th> -->
                <th>Email</th>
                <th>Profile</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['keyword'])) {
                $input = $_POST['keyword'];
                $sql = "SELECT * FROM `users` WHERE firstname LIKE '%$input%' 
                OR lastname LIKE '%$input%' OR id LIKE '%$input%'
                OR phoneNumber LIKE '%$input%' OR email LIKE '%$input%' AND type = 3";
                $exe = $con->query($sql);
                if ($exe->num_rows > 0) {
                    while ($data = $exe->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $data['id']; ?>
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
                            <!-- <td>
                                <?php echo $data['address']; ?>
                            </td> -->
                            <td>
                                <?php echo $data['email']; ?>
                            </td>
                            <td>
                                <img src="../Upload/<?php echo $data['profile']; ?>" alt="" class="rounded-circle" height="40"
                                    width="40">
                            </td>
                            <td>
                                <a href="index.php?pageAdminUpdate=adminUpdate&&id=<?php echo $data['id']; ?>&&action=Update"
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
                                                <a href="index.php?pageAdminDelete=adminDelete&&id=<?php echo $data['id']; ?>"
                                                    class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else{
                    ?> 
                        <h6 class="text-center">
                            <tr>
                                <td colspan='8' class="text-center">No data found!</td>
                            </tr>
                        </h6>
                    <?php 
                }
            }
            ?>
        </tbody>
    </table>