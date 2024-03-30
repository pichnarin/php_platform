
<?php
session_start();
include('header.php');
include('productQuery.php');
include('queryCategory.php');

$shopID = $_SESSION['shopID'];
?>

<div class="wrapper">
    <!-- Sidebar -->
    <?php include('sidebar.php'); ?>

    <div class="main">
        <!-- Slider for the sidebar -->
        <?php include('sidebarSlider.php'); ?>

        <main class="content px-3 py-2">
            <div class="container-fluid">
                <div class="row">
                    <!-- Total earning -->
                    <div class="card-custom border-o">
                        <?php
                        if (isset($_SESSION['product-success'])) {
                            // Display the success message
                            echo "<div class='alert alert-success'>" . $_SESSION['product-success'] . "</div>";

                            // Unset the session variable to remove the message after displaying it
                            unset($_SESSION['product-success']);
                        }
                        ?>
                        <div class="card-header">
                            <h5 class="card-title">Inventory Management</h5>
                            <h6 class="card-subtitle ">Manage products</h6>
                        </div>
                        <div class="card-body">
                            <!-- Search container -->
                            <div class="search-container">
                                <input type="text" id="searchInput" class="form-control search-bar" placeholder="Search...">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-addproduct btn-cadetblue" data-bs-toggle="modal" data-bs-target="#modalId">
                                        Add Product
                                    </button>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table border border-dark rounded p-3 mb-3">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Render product rows -->
                                        <?php foreach ($products as $product): ?>
                                            <tr>
                                                <th scope="row"><?php echo $product['id']; ?></th>
                                                <td><?php echo $product['product_name']; ?></td>
                                                <td><?php echo $product['category_name']; ?></td>
                                                <td><?php echo $product['descriptions']; ?></td>
                                                <td><?php echo $product['price']; ?></td>
                                                <td><?php echo $product['stock_amount']; ?></td>
                                                <td><?php echo $product['discount']; ?></td>
                                                <td><img src="<?php echo $product['product_image']; ?>" alt="product image" height="80px"></td>
                                                <td>

Lay Sopanha, [3/5/2024 3:08 PM]
<div class="btn-group" role="group" aria-label="Product Actions">
                                                        <a href="deleteProduct.php?id=<?php echo $product['id']; ?>" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></a>
                                                        <button type="button" class="btn btn-cadetblue update-btn" data-product-id="<?php echo $product['id']; ?>"><i class="fa-regular fa-pen-to-square"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal Body-->
<div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header custom-modal">
                <h5 class="modal-title" id="modalTitleId">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form action="addProduct.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="productName" required>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select id="category" name="category" class="form-select">
                                    <option value="">Select a category</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

Lay Sopanha, [3/5/2024 3:08 PM]
<div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock Amount</label>
                                <input type="number" class="form-control" name="stock" required>
                            </div>
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount</label>
                                <input type="number" class="form-control" name="discount" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image URL</label>
                                <input type="file" class="form-control" name="image" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-cadetblue" name="btnProduct">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<script>
    $('.update-btn').click(function() {
        var productId = $(this).data('product-id');
        $.ajax({
            type: 'GET',
            url: 'getProductDetails.php?productId=' + productId,
            success: function(response) {
                // Remove any existing modal content
                $('#updateModal').remove();
                // Add the modal content to the document body
                $('body').append(response);
                // Show the modal
                $('#updateModal').modal('show');
            }
        });
    });
</script>

<script>
    // JavaScript for searching table
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>