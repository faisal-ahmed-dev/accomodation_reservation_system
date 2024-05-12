<script src="sweetalert2.min.js"></script>
<script src="sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="@sweetalert2/themes/dark/dark.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
  if(isset($message) && $message!='' && isset($message_status) && $message_status!=''){
   foreach(array_combine($message, $message_status) as $code => $name){
      ?>
      <script>
            
                        Swal.fire({
icon: "<?php echo $name;?>", 
html: "<?php echo $code ;?>",  
showCloseButton: true,
background: 'white'
} );
      </script>
 <?php  }
   }
   ?>

<header class="header">

   <section class="flex">

      <a href="../seller/dashboard.php" class="logo">Host<span>Panel</span></a>
      

      <nav class="nav_bar">
         <a href="../seller/dashboard.php">home</a>
         <a href="../seller/products.php">Places</a>
         <a href="../seller/placed_orders.php">orders</a>
         <a href="../seller/seller_messages.php">messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `seller` WHERE id = ?");
            $select_profile->execute([$seller_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="../seller/update_seller_profile.php" class="btn">update profile</a>

         <a href="../components/seller_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
      </div>

   </section>

   

</header>