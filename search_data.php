

<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.0/moment.min.js"></script>
   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
<script src="js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>



   <?php
    
     $search_box = $_POST['search_query'];
     if (strlen($search_box)>2)
     {
     
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%' or p_country LIKE '%{$search_box}%' or p_state LIKE '%{$search_box}%' or p_city LIKE '%{$search_box}%' limit 10"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <!--
   <section class="products" style="padding-top: 0;">

      <div class="box-container">
      <form id="search_list"action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <input type="hidden" name="seller_id" value="<?= $fetch_product['seller_id']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" target="_blank">
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      </a>
      <div class="name"><?= $fetch_product['p_city']; ?>, <?= $fetch_product['p_country']; ?></div>
      <div class="flex">
         <div class="price"><span>৳</span><?= $fetch_product['price']; ?><span>/-</span></div>
      </div>
   </form>
   </div>

   </section>
      -->
     
   <section class='products' >
                           <div class="box-container">
                                 <div class="box" >
                                 <form id="search_list"action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <input type="hidden" name="seller_id" value="<?= $fetch_product['seller_id']; ?>">
                             
                              
                              <swiper-container class="mySwiper" pagination='true' pagination-clickable='true'style="--swiper-pagination-color: white;--swiper-pagination-bullet-size: 5px; --swiper-pagination-bullet-horizontal-gap: 3px;" >

                                    
                                    <swiper-slide>
                                    <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" target="_blank">
                                          <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                                          <button id='wish' class="fa-regular fa-heart" type="submit" name="add_to_wishlist"></button>
                                    </a>
                                    </swiper-slide>
                                    
                                    
                                    <swiper-slide>
                                    <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" target="_blank">
                                       <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="">
                                       <button id='wish' class="fa-regular fa-heart" type="submit" name="add_to_wishlist"></button>
                                    </a>
                                    </swiper-slide>
                                    <swiper-slide>
                                    <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" target="_blank">
                                          <img src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="">
                                          <button id='wish' class="fa-regular fa-heart" type="submit" name="add_to_wishlist"></button>
                                    </a>
                                    </swiper-slide>
                              </swiper-container >
                              <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" target="_blank">
                              <div class="name"><?= $fetch_product['p_city']; ?>, <?= $fetch_product['p_country']; ?></div>
                                 <div class="flex">
                                 <div class="card">
                                    <div class="flex-btn title">
                                    <span class='date-title'>Date</span>
                                    <span class='price-title'>Price</span>
                                    </div>    

                                    <div class="flex-btn ">
                                    <p class="grid-item date"><span id='checkin'><?php echo date('M j',strtotime($fetch_product['p_checkin'])); ?></span>-<span id='checkout'><?php echo date('M j',strtotime($fetch_product['p_checkout'])); ?></span></p>
                                    <p class="grid-item "><span id='price'>$<?= $fetch_product['price']; ?></span><span></span></p>
                                 </div>
                                  </div>                           
                                 </a>
                                  
                                
                       

              </div>

                              </div>
                         </form>
                           </div>
                           </div>
                             
                        </section>
   <?php
         }
      }else{
        
         echo '<p class="empty">no places found!</p>';
      }
   }
   ?>

  
