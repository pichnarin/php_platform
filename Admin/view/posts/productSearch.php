<?php
$con = new mysqli('localhost', 'root', '', 'fashion');
?>
    <table class="table table-hover table-striped table-responsive-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <!-- <th>Shop</th> -->
                <!-- <th>Address</th> -->
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Discount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['keyword'])) {
                $input = $_POST['keyword'];
                $sql = "SELECT * FROM `products` WHERE product_name LIKE '%$input%'";
                $exe = $con->query($sql);
                if ($exe->num_rows > 0) {
                    while ($data = $exe->fetch_assoc()) {
                        ?>
                        <tr>
                        <td>
                                <?php echo $data['id']; ?>
                            </td>
                            <td>
                                <img src="../../Front-end/assets/img/<?php echo $data['product_image'];?>" alt="" height="50">
                            </td>
                            <td>
                                <?php echo $data['product_name']; ?>
                            </td>
                            <td>
                                <?php echo $data['descriptions']; ?>
                            </td>
                            <td>
                                <?php echo "$".$data['price']; ?>
                            </td>
                            <td>
                                <?php echo $data['stock_amount'];?>
                            </td>
                            <td>
                                <?php echo $data['discount'] . "%";?>
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