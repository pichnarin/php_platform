<?php 
    // session_start();
    require("./main.php");
    require("../model/class/total.php");
?>
<link rel="stylesheet" href="./style.css">

        <div class="container mt-4">
            <?php
                // page dashboard 
                if(isset($_GET['pageDashboard']) == "dashboard"){
                    require("./dashboard/dashboard.php");
                }

                // page admin
                else if(isset($_GET['pageAdmin']) == "admin"){
                    require("./user/admin.php");
                }
                else if(isset($_GET['pageAdminAdd']) == "adminAdd"){
                    require("../model/user/admin/addAdmin.php");
                }
                else if(isset($_GET['pageAdminDelete']) == "adminDelete"){
                    require("../model/user/admin/deleteAdmin.php");
                }
                else if(isset($_GET['pageAdminUpdate']) == "adminUpdate"){
                    require("../model/user/admin/updateAdmin.php");
                }

                // page customer
                else if(isset($_GET['pageCustomer']) == "customer"){
                    require("./user/customer.php");
                }
                else if(isset($_GET['pageCustomerAdd']) == "customerAdd"){
                    require("../model/user/customer/addCustomer.php");
                }
                else if(isset($_GET['pageCustomerDelete']) == "customerDelete"){
                    require("../model/user/customer/deleteCustomer.php");
                }
                else if(isset($_GET['pageCustomerUpdate']) == "customerUpdate"){
                    require("../model/user/customer/updateCustomer.php");
                }

                // page seller 
                else if(isset($_GET['pageSeller']) == "seller"){
                    require("./user/seller.php");
                }
                else if(isset($_GET['pageSellerAdd']) == "sellerAdd"){
                    require("../model/user/seller/addSeller.php");
                }
                else if(isset($_GET['pageSellerDelete']) == "sellerDelete"){
                    require("../model/user/seller/deleteSeller.php");
                }
                else if(isset($_GET['pageSellerUpdate']) == "sellerUpdate"){
                    require("../model/user/seller/updateSeller.php");
                }


                // page setup

                // 1. logo
                else if(isset($_GET['pageLogo']) == "logo"){
                    require("./setup/logo.php");
                }
                else if(isset($_GET['pageLogoAdd']) == "logoAdd"){
                    require("../model/setup/logo/addLogo.php");
                }
                else if(isset($_GET['pageLogoUpdate']) == "logoUpdate"){
                    require("../model/setup/logo/updateLogo.php");
                }
                else if(isset($_GET['pageLogoDelete']) == "logoDelete"){
                    require("../model/setup/logo/deleteLogo.php");
                }
                
                // 2. Menu
                else if(isset($_GET['pageMenu']) == "menu"){
                    require("./setup/menu.php");
                }
                else if(isset($_GET['pageMenuAdd']) == "menuAdd"){
                    require("../model/setup/menu/addMenu.php");
                }
                else if(isset($_GET['pageMenuUpdate']) == "menuUpdate"){
                    require("../model/setup/menu/updateMenu.php");
                }
                else if(isset($_GET['pageMenuDelete']) == "menuDelete"){
                    require("../model/setup/menu/deleteMenu.php");
                }

                 // 3. Advertizement
                else if(isset($_GET['pageAds']) == "ads"){
                    require("./setup/advertizement.php");
                }
                else if(isset($_GET['pageAdsAdd']) == "adsAdd"){
                    require("../model/setup/advertizement/addAds.php");
                }
                else if(isset($_GET['pageAdsUpdate']) == "adsUpdate"){
                    require("../model/setup/advertizement/updateAds.php");
                }
                else if(isset($_GET['pageAdsDelete']) == "adsDelete"){
                    require("../model/setup/advertizement/deleteAds.php");
                }
                 // 4. Footer
                 else if(isset($_GET['pageFooter']) == "footer"){
                    require("./setup/footer.php");
                }
                else if(isset($_GET['pageFooterAdd']) == "footerAdd"){
                    require("../model/setup/footer/addFooter.php");
                }
                else if(isset($_GET['pageFooterUpdate']) == "footerUpdate"){
                    require("../model/setup/footer/updateFooter.php");
                }
                else if(isset($_GET['pageFooterDelete']) == "footerDelete"){
                    require("../model/setup/footer/deleteFooter.php");
                }
                
                // page stock

                // else if(isset($_GET['pageStock']) == "stock"){
                //     require("./posts/stock.php");
                // }
                // else if(isset($_GET['pageStockAdd']) == "stockAdd"){
                //     require("../model/posts/stock/addStock.php");
                // }
                // else if(isset($_GET['pageStockUpdate']) == "stockUpdate"){
                //     require("../model/posts/stock/updateStock.php");
                // }
                // else if(isset($_GET['pageStockDelete']) == "stockDelete"){
                //     require("../model/posts/stock/deleteStock.php");
                // }

                // page product

                else if(isset($_GET['pageProduct']) == "product"){
                    require("./posts/product.php");
                }
                else if(isset($_GET['pageProductAdd']) == "productAdd"){
                    require("../model/posts/product/addProduct.php");
                }
                else if(isset($_GET['pageProductUpdate']) == "productUpdate"){
                    require("../model/posts/product/UpdateProduct.php");
                }
                else if(isset($_GET['pageProductDelete']) == "productDelete"){
                    require("../model/posts/product/deleteProduct.php");
                }

                //page category

                else if(isset($_GET['pageCategory']) == "category"){
                    require("./posts/category.php");
                }
                else if(isset($_GET['pageCategoryAdd']) == "CategoryAdd"){
                    require("../model/posts/category/addCategory.php");
                }
                else if(isset($_GET['pageCategoryUpdate']) == "categoryUpdate"){
                    require("../model/posts/category/UpdateCategory.php");
                }
                else if(isset($_GET['pageCategoryDelete']) == "categoryDelete"){
                    require("../model/posts/category/deleteCategory.php");
                }else if(isset($_GET['pageOrder']) == "order"){
                    require("./order/view_order.php");
                }else if(isset($_GET['pageDeleteOrder']) == "deleteOrder"){
                    require("../model/orders/delete_order.php");
                }else if(isset($_GET['pageUpdateOrder'])=="updateOrder"){
                    require("../model/orders/update_order.php");
                }

            ?>
        </div>
    </div>
</div>