<?php

// User

class User
{
    public function getAllUsers()
    {
        global $con;
        $sql = "SELECT * FROM `users` as u inner join `type` as t on u.type = t.id";
        $exe = $con->query($sql);
        $data = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($data, $res);
            }
        }
        return $data;
    }
    public function getUserAdmin()
    {
        global $con;
        $sql = "SELECT u.id as admin_id , u.profile , u.firstname , u.lastname , u.email , u.phoneNumber , u.username , u.password , t.type FROM `users` as u inner join `user_type` as t on u.type = t.id WHERE u.type = 1";
        $exe = $con->query($sql);
        $data = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($data, $res);
            }
        }
        return $data;
    }
    public function getUserAdminById($id)
    {
        global $con;
        $sql = "SELECT u.id as admin_id , u.profile , u.firstname , u.lastname , u.email , u.phoneNumber , u.username , u.password , t.type FROM `users` as u inner join `user_type` as t on u.type = t.id WHERE u.type = 1 AND u.id = '$id'";
        $exe = $con->query($sql);
        if ($exe->num_rows > 0) {
            $res = $exe->fetch_assoc();
        }
        return $res;
    }
    public function searchUserAdmin($keyword)
    {
        global $con;
        $sql = "SELECT u.id as admin_id, u.profile, u.firstname, u.lastname, u.email, u.phoneNumber, u.username, u.password, t.type 
            FROM `users` as u 
            INNER JOIN `user_type` as t ON u.type = t.id 
            WHERE u.type = 1 
            AND (u.firstname LIKE '%$keyword%' OR u.lastname LIKE '%$keyword%' OR u.email LIKE '%$keyword%' OR u.phoneNumber LIKE '%$keyword%')";
        $exe = $con->query($sql);
        $data = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($data, $res);
            }
        }
        return $data;
    }
    public function getUserCustomer()
    {
        global $con;
        $sql = "SELECT u.id as customer_id , u.profile , u.firstname , u.lastname , u.email , u.phoneNumber , u.username , u.password , t.type FROM `users` as u inner join `user_type` as t on u.type = t.id WHERE u.type = 2";
        $exe = $con->query($sql);
        $data = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($data, $res);
            }
        }
        return $data;
    }
    public function getUserLogin()
    {
        global $con;
        $sql = "SELECT u.id as customer_id , u.profile , u.firstname , u.lastname , u.email , u.phoneNumber , u.username , u.password , t.type FROM `users` as u inner join `user_type` as t on u.type = t.id ";
        $exe = $con->query($sql);
        $data = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($data, $res);
            }
        }
        return $data;
    }
    public function getUserCustomerById($id)
    {
        global $con;
        $sql = "SELECT u.id as customer_id , u.profile , u.firstname , u.lastname , u.email , u.phoneNumber , u.username , u.password , t.type FROM `users` as u inner join `user_type` as t on u.type = t.id WHERE u.type = 2 AND u.id = '$id'";
        $exe = $con->query($sql);
        if ($exe->num_rows > 0) {
            $res = $exe->fetch_assoc();
        }
        return $res;
    }
    public function getUserById($id)
    {
        global $con;
        $sql = "SELECT u.id as customer_id , u.profile , u.firstname , u.lastname , u.email , u.phoneNumber , u.username , u.password , t.type FROM `users` as u inner join `user_type` as t on u.type = t.id WHERE u.id = '$id'";
        $exe = $con->query($sql);
        if ($exe->num_rows > 0) {
            $res = $exe->fetch_assoc();
        }
        return $res;
    }
    public function usernameExists($username)
    {
        global $con;
        $username = $con->real_escape_string($username);

        $sql = "SELECT COUNT(*) as count FROM users WHERE username = '$username'";
        $result = $con->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $count = $row['count'];
            return $count > 0;
        } else {
            return false;
        }

    }


    public function getUserSeller()
    {
        global $con;
        $sql = "SELECT  u.id as seller_id , u.id_card , s.shop_name ,s.street , s.zipcode , s.city , s.region , s.country , u.profile , u.firstname , u.lastname , u.email , u.phoneNumber , u.username , u.password , t.type FROM `users` as u inner join `user_type` as t on u.type = t.id 
        inner join `shop` as s on s.seller_id = u.id WHERE u.type = 3";
        $exe = $con->query($sql);
        $data = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($data, $res);
            }
        }
        return $data;
    }
    public function getUserSellerAndShopById($id)
    {
        global $con;
        $sql = "SELECT  u.id as seller_id , u.id_card , s.shop_name ,s.street , s.zipcode , s.city , s.region  , s.country , u.profile , u.firstname , u.lastname , u.email , u.phoneNumber , u.username , u.password , t.type FROM `users` as u inner join `user_type` as t on u.type = t.id 
        inner join `shop` as s on s.seller_id = u.id WHERE u.type = 3 AND u.id = $id";
        $exe = $con->query($sql);
        $data = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($data, $res);
            }
        }
        return $data;
    }
    public function getUserSellerById($id)
    {
        global $con;
        $sql = "SELECT u.id as seller_id , s.id as shop_id , u.profile , u.firstname , u.lastname , u.email , u.phoneNumber , u.username , u.password , t.type FROM `users` as u inner join `user_type` as t on u.type = t.id 
        inner join `shop` as s on s.seller_id = u.id WHERE u.type = 3 AND u.id = '$id'";
        $exe = $con->query($sql);
        if ($exe->num_rows > 0) {
            $res = $exe->fetch_assoc();
        }
        return $res;
    }
    public function deleteUser($id)
    {
        global $con;
        $sql = "DELETE FROM `users` WHERE id='$id'";
        $exe = $con->query($sql);
    }
    public function updateUser($id, $firstname, $lastname, $email, $phone, $username, $password, $profile)
    {
        global $con;
        $sql = "UPDATE `users` SET `firstname` = ? , `lastname` = ? , `email` = ? , `phoneNumber` = ? , `username` = ? , `password` = ? , `profile` = ?  WHERE id = '$id'";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssss", $firstname, $lastname, $email, $phone, $username, $password, $profile);
        $stmt->execute();
    }
    public function insertUser($firstname, $lastname, $email, $phone, $username, $password, $profile, $type)
    {
        global $con;
        $sql = "INSERT INTO `users` (`firstname` , `lastname` , `email` , `phoneNumber` , `username` , `password` , `profile` , `type`) 
                    VALUES (? , ? , ? , ? , ? , ? , ? , ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssssi", $firstname, $lastname, $email, $phone, $username, $password, $profile, $type);
        $stmt->execute();
    }
}

// Logo
class Logo
{
    public function getLogo()
    {
        global $con;
        $sql = "SELECT * FROM `logo`";
        $exe = $con->query($sql);
        $data = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($data, $res);
            }
        }
        return $data;
    }
    public function deleteLogo($id)
    {
        global $con;
        $sql = "DELETE FROM `logo` WHERE id='$id'";
        $con->query($sql);
    }
    public function updateLogo($id, $logo, $des, $status)
    {
        global $con;
        $sql = "UPDATE `logo` SET `logo` = ? , `description` = ? , `status` = ? WHERE id = '$id'";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $logo, $des, $status);
        $stmt->execute();
    }
    public function insertLogo($logo, $des, $status)
    {
        global $con;
        $sql = "INSERT INTO `logo` (`logo` , `description` , `status`) 
                    VALUES (? , ? , ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $logo, $des, $status);
        $stmt->execute();
    }
    public function getActiveLogo()
    {
        global $con;
        $sql = "SELECT * FROM `logo` WHERE `status` = 'Active'";
        $exe = $con->query($sql);
        if ($exe->num_rows > 0) {
            $data = $exe->fetch_assoc();
            $currentImg = $data['logo'];
            return $currentImg;
        } else {
            echo "No Logo";
        }

    }
    public function getActiveDes()
    {
        global $con;
        $sql = "SELECT * FROM `logo` WHERE `status` = 'Active'";
        $exe = $con->query($sql);
        if ($exe->num_rows > 0) {
            $data = $exe->fetch_assoc();
            $currentImg = $data['description'];
            return $currentImg;
        } else {
            echo "No Logo";
        }

    }
}

// Menu 
class Menu
{
    public function getAllMenu()
    {
        global $con;
        $sql = "SELECT * FROM `menu_setup`";
        $exe = $con->query($sql);
        $result = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($result, $res);
            }
        }
        return $result;
    }
    public function getActiveMenu()
    {
        global $con;
        $sql = "SELECT * FROM `menu_setup` WHERE `status` = 'Active' ORDER BY `order_menu` LIMIT 5";
        $exe = $con->query($sql);
        $result = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($result, $res);
            }
        }
        return $result;
    }
    public function getMenuById($id)
    {
        global $con;
        $sql = "SELECT * FROM `menu_setup` WHERE id = '$id'";
        $exe = $con->query($sql);
        if ($exe->num_rows > 0) {
            $res = $exe->fetch_assoc();
        }
        return $res;
    }
    public function deleteMenu($id)
    {
        global $con;
        $sql = "DELETE FROM `menu_setup` WHERE `id` = '$id'";
        $exe = $con->query($sql);
    }
    public function updateMenu($id, $title, $order_menu, $url, $status)
    {
        global $con;
        $sql = "UPDATE `menu_setup` SET title = ? , order_menu = ? , `menu_url` = ? , `status` = ? WHERE `id` = '$id'";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("siss", $title, $order_menu, $url, $status);
        $stmt->execute();
    }
    public function insertMenu($title, $order_menu, $url, $status)
    {
        global $con;
        $sql = "INSERT INTO `menu_setup` (`title` , `order_menu`, `menu_url` , `status`) 
                    VALUES (? , ? , ? , ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("siss", $title, $order_menu, $url, $status);
        $stmt->execute();
    }
}

// advertizement
class Advertizement
{
    public function getAllAds()
    {
        global $con;
        $sql = "SELECT * FROM `advertizement`";
        $exe = $con->query($sql);
        $ads = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($ads, $res);
            }
        }
        return $ads;
    }
    public function getActiveAds()
    {
        global $con;
        $sql = "SELECT * FROM `advertizement` WHERE `status` = 'Active'";
        $exe = $con->query($sql);
        $ads = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($ads, $res);
            }
        }
        return $ads;
    }
    public function deleteAds($id)
    {
        global $con;
        $sql = "DELETE FROM `advertizement` WHERE `id` = '$id'";
        $exe = $con->query($sql);
    }
    public function deleteAdsAll()
    {
        global $con;
        $sql = "DELETE FROM `advertizement`";
        $exe = $con->query($sql);
    }
    public function updateAds($id, $ads_img, $ads_video, $ads_url, $des, $status)
    {
        global $con;
        $sql = "UPDATE `advertizement` SET `ads_img` = ? , ads_video = ? , `ads_url` = ? , `description` = ? , `status` = ?  WHERE id = '$id'";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssss", $ads_img, $ads_video, $ads_url, $des, $status);
        $stmt->execute();
    }
    public function insertAds($ads_img, $ads_video, $ads_url, $des, $status)
    {
        global $con;
        $sql = "INSERT INTO `advertizement` (`ads_img` , `ads_video` , `ads_url` , `description` , `status`) 
                    VALUES (? , ? , ? , ? , ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssss", $ads_img, $ads_video, $ads_url, $des, $status);
        $stmt->execute();
    }
}

// Category
class Category
{
    public function getAllCategory()
    {
        global $con;
        $sql = "SELECT * FROM `categorys`";
        $exe = $con->query($sql);
        $cate = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($cate, $res);
            }
        }
        return $cate;
    }
    public function getCategoryById($id)
    {
        global $con;
        $sql = "SELECT * FROM `categorys` WHERE `id` = '$id'";
        $exe = $con->query($sql);
        if ($exe->num_rows > 0) {
            $row = $exe->fetch_assoc();
            return $row;
        }
    }
    public function deleteCategory($id)
    {
        global $con;
        $sql = "DELETE FROM `categorys` WHERE `id` = '$id'";
        $exe = $con->query($sql);
    }
    public function deleteAllCategory()
    {
        global $con;
        $sql = "DELETE FROM `categorys`";
        $exe = $con->query($sql);
    }
    public function updateCategory($id, $category_name, $description)
    {
        global $con;
        $sql = "UPDATE `categorys` SET `category_name` = ? , `descriptions` = ? WHERE `id` = '$id'";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $category_name, $description);
        $stmt->execute();
    }
    public function insertCategory($category_name, $description)
    {
        global $con;
        $sql = "INSERT INTO `categorys` (`category_name` , `descriptions`) 
                    VALUES (? , ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $category_name, $description);
        $stmt->execute();
    }
}
class Product
{
    public function getAllProduct()
    {
        global $con;
        $sql = "SELECT P.* , 
                    S.shop_name,
                    C.category_name
                    FROM `products` AS P 
                    LEFT JOIN `shop` AS S ON S.id = P.shop_id 
                    LEFT JOIN `categorys` AS C ON P.category_id = C.id";
        $exe = $con->query($sql);
        $product = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($product, $res);
            }
        } else {
            echo "No data";
        }
        return $product;
    }
    public function getProductById($id)
    {
        global $con;
        $sql = "SELECT * FROM `products` WHERE `id` = '$id'";
        $exe = $con->query($sql);
        if ($exe->num_rows > 0) {
            $row = $exe->fetch_assoc();
            return $row;
        }
    }
    public function getAmountProduct()
    {
        global $con;
        $sql = "SELECT COUNT(id) AS Total FROM `products`";
        $exe = $con->query($sql);
        if ($exe->num_rows > 0) {
            $row = $exe->fetch_assoc();
            return $row;
        }
    }
    public function deleteProduct($id)
    {
        global $con;
        $sql = "DELETE FROM `products` WHERE `id` = '$id'";
        $exe = $con->query($sql);
    }
    public function deleteAllProduct()
    {
        global $con;
        $sql = "DELETE FROM `products`";
        $exe = $con->query($sql);
    }
    public function updateProduct($id, $product_name, $des, $price, $category_id, $stock, $dis, $product_url)
    {
        global $con;
        $sql = "UPDATE `products` SET `product_name` = ?  , `descriptions` = ? , `price` = ? , `category_id` = ? , `stock_amount`= ? , `discount` = ? , `product_image` = ? WHERE `id` = '$id'";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssdiiss", $product_name, $des, $price, $category_id, $stock, $dis, $product_url);
        $stmt->execute();
    }
    public function insertProduct($product_name, $shop, $des, $price, $category_id, $stock, $dis, $product_url)
    {
        global $con;
        $sql = "INSERT INTO `products` (`product_name` , `shop_id` , `descriptions` , `price` , `category_id` , `stock_amount` , `discount` , `product_image`) 
                    VALUES (? , ? , ? , ? , ? , ? , ? , ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sisdiiss", $product_name, $shop, $des, $price, $category_id, $stock, $dis, $product_url);
        $stmt->execute();
    }
    public function getAmountOfProduct()
    {
        global $con;
        $sql = "SELECT COUNT(id) as totalProduct from `products`";
        $exe = $con->query($sql);
        while ($data = $exe->fetch_assoc()) {
            $total = $data['totalProduct'];
        }
        return $total;
    }
}


class Stock
{
    public function getAllStock()
    {
        global $con;
        $sql = "SELECT * FROM `stocks`";
        $exe = $con->query($sql);
        $stock = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($stock, $res);
            }
        }
        return $stock;
    }
    public function deleteStock($id)
    {
        global $con;
        $sql = "DELETE FROM `stocks` WHERE `id` = '$id'";
        $exe = $con->query($sql);
    }
    public function deleteAllStock()
    {
        global $con;
        $sql = "DELETE FROM `stocks`";
        $exe = $con->query($sql);
    }
    public function updateStock($id, $stock_name, $amount, $price, $stock_in, $stock_out)
    {
        global $con;
        $sql = "UPDATE `products` SET `stock_name` = ? , `amount` = ? , `price` = ? , `stock_in` = ? , `stock_out`= ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sidis", $stock_name, $amount, $price, $stock_in, $stock_out);
        $stmt->execute();
    }
    public function insertStock($stock_name, $amount, $price, $stock_in, $stock_out)
    {
        global $con;
        $sql = "INSERT INTO `categorys` (`stock_name` , `amount` , `price` , `stock_in` , `stock_out`) 
                    VALUES (? , ? , ? , ? , ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sidis", $stock_name, $amount, $price, $stock_in, $stock_out);
        $stmt->execute();
    }
}


class Discount
{
    public function getAllDiscount()
    {
        global $con;
        $sql = "SELECT * FROM `discount`";
        $exe = $con->query($sql);
        $discount = [];
        if ($exe->num_rows > 0) {
            while ($row = $exe->fetch_assoc()) {
                array_push($discount, $row);
            }
        } else {
            echo "No data";
        }
        return $discount;
    }
}


// footer

class Footer
{
    public function getAllFooter()
    {
        global $con;
        $sql = "SELECT * FROM `footer`";
        $exe = $con->query($sql);
        $result = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($result, $res);
            }
        }
        return $result;
    }
    public function getActiveFooter()
    {
        global $con;
        $sql = "SELECT * FROM `footer` WHERE `status` = 'Active'";
        $exe = $con->query($sql);
        $result = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($result, $res);
            }
        }
        return $result;
    }
    public function getActiveOnlyOneFooter()
    {
        global $con;
        $sql = "SELECT * FROM `footer` WHERE `status` = 'Active' ORDER BY `id` LIMIT 1";
        $exe = $con->query($sql);
        $result = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($result, $res);
            }
        }
        return $result;
    }
    public function getFooterById($id)
    {
        global $con;
        $sql = "SELECT * FROM `footer` WHERE id = '$id'";
        $exe = $con->query($sql);
        if ($exe->num_rows > 0) {
            $res = $exe->fetch_assoc();
        }
        return $res;
    }
    public function deleteFooter($id)
    {
        global $con;
        $sql = "DELETE FROM `footer` WHERE `id` = '$id'";
        $exe = $con->query($sql);
    }
    public function deleteAllFooter()
    {
        global $con;
        $sql = "DELETE FROM `footer`";
        $exe = $con->query($sql);
    }
    public function updateFooter($id, $email, $phone, $location, $des, $icon, $url_social, $status)
    {
        global $con;
        $sql = "UPDATE `footer` SET `email` = ? , `phone` = ? , `location` = ? , `description` = ? ,`icon_social` = ? , `url_social` = ? , `status` = ? WHERE `id` = '$id'";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssss", $email, $phone, $location, $des, $icon, $url_social, $status);
        $stmt->execute();
    }
    public function insertFooter($email, $phone, $location, $des, $icon, $url_social, $status)
    {
        global $con;
        $sql = "INSERT INTO `footer` (`email` , `phone`, `location` , `description` , `icon_social` , `url_social` , `status`) 
                    VALUES (? , ? , ? , ? , ? , ? , ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssss", $email, $phone, $location, $des, $icon, $url_social, $status);
        $stmt->execute();
    }
}


// Shop

class Shop
{
    public function getAmountOfShop()
    {
        global $con;
        $sql = "SELECT COUNT(id) as totalShop from `shop`";
        $exe = $con->query($sql);
        while ($data = $exe->fetch_assoc()) {
            $total = $data['totalShop'];
        }
        return $total;
    }
    public function getAllShops()
    {
        global $con;
        $sql = "SELECT * FROM `shop`";
        $exe = $con->query($sql);
        $data = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($data, $res);
            }
        }
        return $data;
    }
}





// footer

// Shop


class Order
{
    public function insertToOrder($user_id, $product_id, $amount, $size, $paid, $location, $order_status_id)
    {
        global $con;
        $sql = "INSERT INTO orders (id, user_id, product_id, amount, size , payment_invoice , location, order_status_id) 
                    VALUES (null,? , ? , ?, ?, ? , ? , ?)";

        $stml = $con->prepare($sql);
        $stml->bind_param("iiisssi", $user_id, $product_id, $amount, $size, $paid, $location, $order_status_id);
        $result=$stml->execute();
        if($result){
            return true;
        }
        else {
            return false;
        }
    }

    public function get_all_order()
    {
        global $con;
        $sql = "SELECT o.id as orders, user_id, s.shop_name, p.product_name, o.amount, o.payment_invoice, o.location, o.order_status_id, o.order_time, o.size, concat(u.firstname,' ', u.lastname) as names
        FROM orders as o 
        INNER JOIN products as p ON o.product_id = p.id 
        INNER JOIN shop as s ON s.id = p.shop_id
        INNER JOIN users as u ON u.id = o.user_id";
        $exe = $con->query($sql);
        $order = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($order, $res);
            }
        }
        return $order;
    }

    public function get_all_order_by_id($id)
    {
        global $con;
        $sql = "SELECT * FROM `orders` WHERE id = '$id'";
        $exe = $con->query($sql);
        if ($exe->num_rows > 0) {
            $res = $exe->fetch_assoc();
        }
        return $res;
    }

    public function update_order_status_by_id($id, $status)
    {
        global $con;
        $sql = "UPDATE `orders` SET `order_status_id`= ? WHERE `id` = $id";
        $stml = $con->prepare($sql);
        $stml->bind_param("i", $status);
        $stml->execute();
    }

    public function get_order_status()
    {
        global $con;
        $sql = "SELECT * FROM order_status";
        $exe = $con->query($sql);
        $order_status = [];
        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                array_push($order_status, $res);
            }
        }
        return $order_status;
    }
    public function delete_order_by_id($id)
    {
        global $con;
        $sql = "DELETE FROM `orders` WHERE `id` = $id";
        $exe = $con->prepare($sql);
        $exe->execute();
    }

    public function delete_all_order()
    {
        global $con;
        $sql = "DELETE FROM `orders`";
        $exe = $con->prepare($sql);
        $exe->execute();
    }
    public function update_order_by_id($id, $amount, $payment_invoice, $location, $size)
    {
        global $con;
        $sql = "UPDATE `orders` 
            SET `amount`= ?, `payment_invoice`= ?, `location`= ?, `order_time`= CURRENT_TIMESTAMP, `size`= ? WHERE `id` = ?";
        $exe = $con->prepare($sql);
        if (!$exe) {
            // Handle the error appropriately, like logging or returning an error message
            die('Error in preparing SQL statement: ' . $con->error);
        }
        $exe->bind_param("dsssi", $amount, $payment_invoice, $location, $size, $id);
        $exe->execute();
        if ($exe->affected_rows === 0) {
            // No rows were updated, handle this case accordingly
        }
        $exe->close();
    }

}
?>