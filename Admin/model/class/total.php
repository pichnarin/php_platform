<?php 
    // $con = new mysqli('localhost', 'root', '', 'ecommercefashion');
    Class TotalCustomer{
        public function getTotalCustomer(){
            global $con;
            $sql = "SELECT COUNT(id) AS totalCustomer FROM `users` where `type` = 2";
            $exe = $con->query($sql);
            while($data = $exe->fetch_assoc()){
                $total = $data['totalCustomer'];
            }
            return $total;
        }
        public function getActiveCustomer(){
            global $con;
            $sql = "SELECT COUNT(id) AS totalCustomer FROM customers WHERE status = 'Active'";
            $exe = $con->query($sql);
            while($data = $exe->fetch_assoc()){
                $total = $data['totalCustomer'];
            }
            return $total;
        }
        public function getInactiveCustomer(){
            global $con;
            $sql = "SELECT COUNT(id) AS totalCustomer FROM customers WHERE status = 'Inactive'";
            $exe = $con->query($sql);
            while($data = $exe->fetch_assoc()){
                $total = $data['totalCustomer'];
            }
            return $total;
        }
    }
    Class TotalOrder{
        public function getTotalOrder(){
            global $con;
            $sql = "SELECT COUNT(id) AS totalOrder FROM orders";
            $exe = $con->query($sql);
            while($data = $exe->fetch_assoc()){
                $total = $data['totalOrder'];
            }
            return $total;
        }
    }
?>