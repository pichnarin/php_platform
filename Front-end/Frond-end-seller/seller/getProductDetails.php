<?php

include('header.php');
include('productQuery.php');
include('queryCategory.php');

$productId = $_GET['productId'];

// Query to fetch product details using $productId
$stmt = $con->prepare("SELECT p.id, p.product_name, p.category_id, p.descriptions, p.price, p.stock_amount, p.discount, p.product_image, c.category_name
                        FROM products p 
                        INNER JOIN categorys c ON p.category_id = c.id
                        WHERE p.id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();


?>
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header custom-modal">
                    <h5 class="modal-title" id="modalTitleId">Update Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="updateProduct.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="productId" value="<?php echo $row['id']; ?>">
                                <div class="mb-3">
                                    <label for="productName" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="productName" name="productName" value="<?php echo $row['product_name']; ?>" required>
                                </div>
                                <input type="hidden" name="productId" value="<?php echo $productId; ?>">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <?php
                                        foreach ($categories as $option) {
                                            // Check if the category ID matches the product's category ID
                                            // If yes, mark this option as selected
                                            $selected = ($option['id'] == $row['category_id']) ? 'selected' : '';
                                            echo "<option value='{$option['id']}' $selected>{$option['category_name']}</option>";
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $row['descriptions']; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="<?php echo $row['price']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock Amount</label>
                                    <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $row['stock_amount']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input type="number" class="form-control" id="discount" name="discount" value="<?php echo $row['discount']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Product Image URL</label>
                                    <input type="file" class="form-control" id="image" name="image" value="<?php echo $row['product_image']; ?>" >
                                </div>
                                <div class="mb-3">
                                    <img src="<?php echo $row['product_image']; ?>" alt="product image" height="80px">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-cadetblue" name="btnUpdateProduct">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



<?php
} else {

    echo "Product not found.";
}

include('footer.php');
?>