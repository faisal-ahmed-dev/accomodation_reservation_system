<?php

include '../components/connect.php';

session_start();

$seller_id = $_SESSION['seller_id'];


if(!isset($seller_id)){
   header('location:seller_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/seller_style.css">
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.39.0/apexcharts.min.js"></script>

</head>
<body>

<?php include '../components/seller_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">dashboard</h1>
   
   

   <div class="box-container">

     

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ? and seller_id=?");
            $select_pendings->execute(['pending',$seller_id]);
            if($select_pendings->rowCount() > 0){
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['total_price'];
               }
            }
            
         ?>
         <h3><span>$</span><?= $total_pendings; ?><span>/-</span></h3>
         <p>total pendings</p>
         <a href="placed_orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
         <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ? and seller_id=?");
            $select_completes->execute(['completed',$seller_id]);
            if($select_completes->rowCount() > 0){
               while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['total_price'];
               }
            }
           
         ?>
         <h3><span>$</span><?= $total_completes; ?><span>/-</span></h3>
         <p>completed orders</p>
         <a href="placed_orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
         <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders` where seller_id=?");
            $select_orders->execute([$seller_id]);
            $number_of_orders = $select_orders->rowCount()
         ?>
         <h3><?= $number_of_orders; ?></h3>
         <p>orders placed</p>
         <a href="placed_orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products` where seller_id=?");
            $select_products->execute([$seller_id]);
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>products added</p>
         <a href="products.php" class="btn">see places</a>
      </div>


   </div>

</section>











<script src="../js/seller_script.js"></script>


</body>
</html>