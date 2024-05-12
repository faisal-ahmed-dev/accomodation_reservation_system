<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="orders">

   <h1 class="heading">placed orders</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">please login to see your orders</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
      <div class="box">
      <div class="container">
   <div class="card cart">
      <label class="title">Order id : <?= $fetch_orders['id']; ?></label>
      <label class="title">Placed on : <?= $fetch_orders['placed_on']; ?></label>
      <div class="steps">
         <div class="step">
         <div>
            <span>CUSTOMER DETAILS</span>
            <p> Name           : <?= $fetch_orders['name']; ?></p>
            <p>Email           : <?= $fetch_orders['email']; ?></p>
            <p>Number          : <?= $fetch_orders['number']; ?></p>
            <p>Address         : <?= $fetch_orders['address']; ?></p>
           
            </div>
            <hr>
            <div>
            <span>PLACE DETAILS</span>
            <?php
               $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
               $select_products->execute([$fetch_orders['pid']]);
               if($select_products->rowCount() > 0){
                  while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            <p>Place name            : <?= $fetch_products['name']; ?></p>
            <p>Address           : <?= $fetch_products['p_address']; ?></p>
            <p>Max Person          : <?= $fetch_products['p_person']; ?></p>
            <p>Checkin           : <?= $fetch_orders['checkin']; ?> At 12.00pm</p>
            <p>Checkout          : <?= $fetch_orders['checkout']; ?> At 11.59am</p>
            <?php
                  } 
               }
            ?>
         </div>
         <hr>
         <div>
            <span>PAYMENT METHOD</span>
            <p>Card Holder Name :<?=$fetch_orders['payment_name']; ?></p>
            <p>Card Number  :<?=$fetch_orders['cardnumber']; ?></p>
         </div>
         <hr>
         <div class="payments">
            <span>PAYMENT</span>
            <p style="color:<?php if($fetch_orders['payment_status'] == 'completed'){ echo 'green'; }else{ echo 'red'; }; ?>"> Order status : <?= $fetch_orders['payment_status']; ?> </p>
         </div>
         </div>
      </div>
   </div>

   <div class="card checkout">
      <div class="footer">
         <label class="price">$  <?= $fetch_orders['total_price']; ?></label>
         <a target="_blank" href="/tourify/quick_view.php?pid=<?= $fetch_orders['pid']; ?>"><button class='view'>View</button></a>
      </div>
   </div>
   </div>
         
         
         
         
         
         
        
         
      </div>
   <?php
      }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      }
   ?>

   </div>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>