<?php

include '../components/connect.php';

session_start();

$seller_id = $_SESSION['seller_id'];

if(!isset($seller_id)){
   header('location:seller_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);
   $bedroom=$_POST['bedroom'];
   $bedroom = filter_var($bedroom, FILTER_SANITIZE_STRING);
   $bed=$_POST['bed'];
   $bed = filter_var($bed, FILTER_SANITIZE_STRING);
   $bath=$_POST['bath'];
   $bath = filter_var($bath, FILTER_SANITIZE_STRING);
   $person=$_POST['person'];
   $person = filter_var($person, FILTER_SANITIZE_STRING);


   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;

   $categoryOption = $_POST['category'];
   $categoryOption = filter_var($categoryOption, FILTER_SANITIZE_STRING);

   

   $countryOption = $_COOKIE['countryoption'];
   $countryOption = filter_var( $countryOption, FILTER_SANITIZE_STRING);
   $stateOption = $_COOKIE['stateoption'];
   $stateOption = filter_var($stateOption, FILTER_SANITIZE_STRING);
   $cityOption = $_COOKIE['cityoption'];
   $cityOption = filter_var($cityOption, FILTER_SANITIZE_STRING);


   $address= $_POST['address'];
   $address=filter_var($address ,FILTER_SANITIZE_STRING );

   $facility= $_POST['facility'];
   $facility=filter_var($facility ,FILTER_SANITIZE_STRING );
   




   

      $insert_products = $conn->prepare("INSERT INTO `products`(name, details, price, image_01, image_02, image_03,category,p_person,p_bedroom,p_bed,p_bath,p_country,p_state,p_city,p_address,seller_id,p_status,p_facility) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03,$categoryOption,$person,$bedroom,$bed,$bath,$countryOption,$stateOption,$cityOption,$address,$seller_id,'not',$facility]);

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = 'image size is too large!';
            $message_status[]='error';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'new product added!';
            $message_status[]='success';
         }

      }

   

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/seller_style.css">

</head>
<body>

<?php include '../components/seller_header.php'; ?>

<section class="add-products">

   <h1 class="heading">add Place</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>Place name *</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter Place name" name="name">
         </div>
         <div class="inputBox">
            <span>Place price *</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="enter Place price" onkeypress="if(this.value.length == 10) return false;" name="price">
         </div>
        

        <div class="inputBox">
            <span>image 01 *</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 02 *</span>
            <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 03 *</span>
            <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
         <div class="inputBox">
            <span>Place details *</span>
            <textarea name="details" placeholder="enter Place details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
        

         <div class="inputBox">
            <span>Bedroom *</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="How many Bedrooms" onkeypress="if(this.value.length == 10) return false;" name="bedroom">
         </div>

         <div class="inputBox">
            <span>Beds *</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="How many Beds" onkeypress="if(this.value.length == 10) return false;" name="bed">
         </div>

         <div class="inputBox">
            <span>Bathrooms *</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="How many Bathrooms" onkeypress="if(this.value.length == 10) return false;" name="bath">
         </div>

         <div class="inputBox">
            <span>Max Person limit *</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="enter person" onkeypress="if(this.value.length == 10) return false;" name="person">
         </div>

         
            
            <div class="inputBox place">
            <select name='country' class="country" size="1" onchange="loadStates();selectcountry(this);">
            <option value="" selected="selected">-- Select Country --</option>
            </select>
            
           
               <select name='state' class="state" size="1" onchange="loadCities();selectstate(this);">
               <option value="" selected="selected">-- Select State --</option>
               </select>
              
               <select class="city" size="1" name="city" onchange='selectcity(this);'>
               <option value="" selected="selected">-- Select City --</option>
               </select>
            </div>

           

           

            <div class="inputBox">
            <span>Address *</span>
            <textarea name="address" placeholder="enter address" class="box" required maxlength="500" cols="30" rows="10"></textarea>
             </div>


             <div class="inputBox">
             </div>
             
            <div class="inputBox">
            <span>Category  *</span>
          
               <select name="category"   required> 
               <option value="">Select</option>
               <option value="room">room</option>
               <option value="beach">beach</option>
               <option value="city">city</option>
               <option value="camping">camping</option>
               <option value="hill">hill</option>
               <option value="forest">forest</option>
               <option value="boat">boat</option>
               <option value="castle">castle</option>
               <option value="golf">golf</option>
               <option value="apartment">apartment</option>
               <option value="tower">tower</option>
               </select>
         </div>
            
         
         <div class="inputBox">
             </div>


         
         <div class="inputBox">
            <span>During Guest Stay Facilities*</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter Facilities" name="facility">
         </div>
         

         

         

      </div>
      
      <input type="submit" value="add product" class="btn" name="add_product">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">products added</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products` where seller_id=?");
      $select_products->execute([$seller_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="price">$<span><?= $fetch_products['price']; ?></span></div>
      <div class="category"><span><?= $fetch_products['category']; ?></span></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['id']; ?>"target="_blank" class="option-btn">update</a>
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>
   
   </div>

</section>




<script>
   function selectcountry(sel){
      $countryOption = sel.options[sel.selectedIndex].text;
      document.cookie='countryoption='+$countryOption;
   }
   function selectstate(sel){
      $stateOption = sel.options[sel.selectedIndex].text;
      document.cookie='stateoption='+$stateOption;
   }
   function selectcity(sel){
      $cityOption = sel.options[sel.selectedIndex].text;
      document.cookie='cityoption='+$cityOption;
      
   }
</script>



<script src="../js/seller_script.js"></script>
<script src='../js/country.js'></script>

</body>
</html>