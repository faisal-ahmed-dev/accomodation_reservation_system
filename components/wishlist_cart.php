<?php

if(isset($_POST['add_to_wishlist'])){

   if($user_id == ''){
      header('location:user_login.php');
   }else{

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $seller_id = $_POST['seller_id'];
      $seller_id = filter_var($seller_id, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE  user_id = ? and pid=?");
      $check_wishlist_numbers->execute([ $user_id,$pid]);

      

      if($check_wishlist_numbers->rowCount() > 0){
         $message[] = 'already added to wishlist!';
         $message_status[]='info';
      }
      else{
         $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, price, image,seller_id,name) VALUES(?,?,?,?,?,?)");
         $insert_wishlist->execute([$user_id, $pid,  $price, $image,$seller_id,$name]);
         $message[] = 'added to wishlist!';
         $message_status[]='success';
      }

   }

}

if(isset($_POST['add_to_cart'])){

   if($user_id == ''){
      header('location:user_login.php');
   }else{

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $seller_id = $_POST['seller_id'];
      $seller_id = filter_var($seller_id, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $checkin = $_POST['checkin'];
      $checkin = filter_var($checkin, FILTER_SANITIZE_STRING);
      $checkout = $_POST['checkout'];
      $checkout = filter_var($checkout, FILTER_SANITIZE_STRING);


      $check_cart_numbers = $conn->prepare("DELETE  FROM `cart`");
      $check_cart_numbers->execute();

         $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE  user_id = ? and pid=?");
         $check_wishlist_numbers->execute([$user_id,$pid]);

         if($check_wishlist_numbers->rowCount() > 0){
            $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE   user_id = ? and pid=?");
            $delete_wishlist->execute([$user_id,$pid]);
         }
         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, price, image,seller_id,name,checkin,checkout) VALUES(?,?,?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $pid, $price,  $image,$seller_id,$name,$checkin,$checkout]);
         header('location:checkout.php');
         
      

   }

}

?>