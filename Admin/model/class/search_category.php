<?php
class Cloth{
    public function getOnlyMenClothes(){
        global $con;
        $sql = "SELECT p.id as product_id , p.product_name , p.product_image , p.descriptions , p.price , p.stock_amount , p.discount , p.shop_id , c.* FROM `products` as p inner join `categorys` as c on p.category_id = c.id where c.category_name = 'Men Clothes'";
        $exe = $con->query($sql);
        $data = [];
        if($exe->num_rows > 0){
            while($res = $exe->fetch_assoc()){
                array_push($data , $res);
            }
        }
        else{
            echo "Empty category, Thanks";
        }
        return $data;
    }
    public function getOnlyMenShoes(){
        global $con;
        $sql = "SELECT p.id as product_id , p.product_name , p.product_image , p.descriptions , p.price , p.stock_amount , p.discount , p.shop_id , c.* FROM `products` as p inner join `categorys` as c on p.category_id = c.id where c.category_name = 'Men Shoes'";
        $exe = $con->query($sql);
        $data = [];
        if($exe->num_rows > 0){
            while($res = $exe->fetch_assoc()){
                array_push($data , $res);
            }
        }
        else{
            echo "Empty category, Thanks";
        }
        return $data;
    }
    public function getOnlyMenWallet(){
        global $con;
        $sql = "SELECT p.id as product_id , p.product_name , p.product_image , p.descriptions , p.price , p.stock_amount , p.discount , p.shop_id , c.* FROM `products` as p inner join `categorys` as c on p.category_id = c.id where c.category_name = 'Men Wallets'";
        $exe = $con->query($sql);
        $data = [];
        if($exe->num_rows > 0){
            while($res = $exe->fetch_assoc()){
                array_push($data , $res);
            }
        }
        else{
            echo "Empty category, Thanks";
        }
        return $data;
    }
    public function getOnlyWomenClothes(){
        global $con;
        $sql = "SELECT p.id as product_id , p.product_name , p.product_image , p.descriptions , p.price , p.stock_amount , p.discount , p.shop_id , c.* FROM `products` as p inner join `categorys` as c on p.category_id = c.id where c.category_name = 'Women Clothes'";
        $exe = $con->query($sql);
        $data = [];
        if($exe->num_rows > 0){
            while($res = $exe->fetch_assoc()){
                array_push($data , $res);
            }
        }
        else{
            echo "Empty category, Thanks";
        }
        return $data;
    }
    public function getOnlyWomenShoes(){
        global $con;
        $sql = "SELECT p.id as product_id , p.product_name , p.product_image , p.descriptions , p.price , p.stock_amount , p.discount , p.shop_id , c.* FROM `products` as p inner join `categorys` as c on p.category_id = c.id where c.category_name = 'Women Shoes'";
        $exe = $con->query($sql);
        $data = [];
        if($exe->num_rows > 0){
            while($res = $exe->fetch_assoc()){
                array_push($data , $res);
            }
        }
        else{
            echo "Empty category, Thanks";
        }
        return $data;
    }
    public function getOnlyWomenWallet(){
        global $con;
        $sql = "SELECT p.id as product_id , p.product_name , p.product_image , p.descriptions , p.price , p.stock_amount , p.discount , p.shop_id , c.* FROM `products` as p inner join `categorys` as c on p.category_id = c.id where c.category_name = 'Women Wallets'";
        $exe = $con->query($sql);
        $data = [];
        if($exe->num_rows > 0){
            while($res = $exe->fetch_assoc()){
                array_push($data , $res);
            }
        }
        else{
            echo "Empty category, Thanks";
        }
        return $data;
    }
}
?>