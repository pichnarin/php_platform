

<aside id="sidebar" class="col-lg-3 col-md-4 col-sm-12">
    <!-- content of side bar -->
    <div class="h-100 sidebar-content">
        <div class="sidebar-logo">
            <a href="dashboard.php">PSN</a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                admin element
            </li>
            <!-- dashboard -->
            <li class="sidebar-item">
                <a href="dashboard.php" class="sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') {
                                                                echo 'active';
                                                            } ?>">
                    <i class="fa-solid fa-list"></i>
                    <label for="" class="title">Dashboard</label>

                </a>
            </li>
            <!-- order -->
            <li class="sidebar-item">
                <a href="order.php" class="sidebar-link collapsed"data-bs-target="#orders" data-bs-toggle="collapse" aria-expanded="false">
                    <i class="fa-solid fa-cart-plus"></i>
                    <label class="title">Order</label>
                </a>
                <ul id="orders" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="orderPendingUI.php" class="sidebar-link" >Pending</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="orderCompletedUI.php" class="sidebar-link">Completed</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="orderCancelledUI.php" class="sidebar-link">Cancelled</a>
                    </li>
                </ul>
            </li>
            <!-- inventory -->
            <li class="sidebar-item">
                <a href="inventory.php" class="sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == 'inventory.php') {
                                                                echo 'active';
                                                            } ?>">
                    <i class="fa-solid fa-box-open"></i>
                    <label class="title">Inventory</label>
                </a>
            </li>

            <!-- Shop management like Ad and Review -->
            <li class="sidebar-item">
                <a href="shop.php" class="sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == 'shop.php') {
                                                                echo 'active';
                                                            } ?>">
                    <i class="fa-solid fa-shop"></i>
                    <label class="title">Shop</label>
                </a>
            </li>



            <!-- setting -->
            <li class="sidebar-item">
                <a href="setting.php" class="sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == 'setting.php') {
                                                                echo 'active';
                                                            } ?>">
                    <i class="fa-solid fa-gear"></i>
                    <label class="title">Setting</label>
                </a>
            </li>

        </ul>
    </div>
</aside>