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

<header class="header" >

   <section class="flex" >
   <button type='button'><a href="home.php" class="logo">Tourify<span>.</span></a></button> 
      

      <nav class="navbar">
      <a href="search_page.php">
      <button type='button'><i class="fas fa-search"><span>Search</span></i></button> </a>
      
      </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="seller/seller_login.php" target="_blank"><i class="fa-solid fa-user-tie"></i>Switch to Hosting</a>
         
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php      
          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><b><?= $fetch_profile["name"]; ?></b></p>
         <a href="chatbox.php" class="btn">Inbox</a>  
         <a href="orders.php" class="btn">My Orders</a> 
         <a href="update_user.php" class="btn">update profile</a> 
                
       
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <?php
            }else{
         ?>
         <p>please login or register first!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>