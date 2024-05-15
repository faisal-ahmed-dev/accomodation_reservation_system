<?php

include '../components/connect.php';

session_start();

$seller_id = $_SESSION['seller_id'];
if(!isset($seller_id)){
   header('location:seller_login.php');
}

if(isset($_POST['update'])){
  
   $pid=$_POST['pid'];
   $pid= filter_var($pid, FILTER_SANITIZE_STRING);
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

   $categoryOption = $_POST['category'];
   $categoryOption = filter_var($categoryOption, FILTER_SANITIZE_STRING);

   



   $address= $_POST['address'];
   $address=filter_var ($address ,FILTER_SANITIZE_STRING );
   $facility= $_POST['facility'];
   $facility=filter_var($facility ,FILTER_SANITIZE_STRING );

   $update_product = $conn->prepare("UPDATE `products` SET name = ?, price = ?, details = ?,category=?,p_bedroom=?,p_person=?,p_bed=?,p_bath=?,p_address=?,p_facility=? WHERE id = ? and seller_id=?");
   $update_product->execute([$name, $price, $details, $categoryOption,$bedroom,$person,$bed,$bath,$address,$facility,$pid,$seller_id]);

   $message[] = 'product updated successfully!';
   $message_status[]='success';

   $old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $message[] = 'image size is too large!';
         $message_status[]='error';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `products` SET image_01 = ? WHERE id = ?");
         $update_image_01->execute([$image_01, $pid]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('../uploaded_img/'.$old_image_01);
         $message[] = 'image 01 updated successfully!';
         $message_status[]='success';
      }
   }

   $old_image_02 = $_POST['old_image_02'];
   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   if(!empty($image_02)){
      if($image_size_02 > 2000000){
         $message[] = 'image size is too large!';
         $message_status[]='error';
      }else{
         $update_image_02 = $conn->prepare("UPDATE `products` SET image_02 = ? WHERE id = ?");
         $update_image_02->execute([$image_02, $pid]);
         move_uploaded_file($image_tmp_name_02, $image_folder_02);
         unlink('../uploaded_img/'.$old_image_02);
         $message[] = 'image 02 updated successfully!';
         $message_status[]='success';
      }
   }

   $old_image_03 = $_POST['old_image_03'];
   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;

   if(!empty($image_03)){
      if($image_size_03 > 2000000){
         $message[] = 'image size is too large!';
         $message_status[]='error';
      }else{
         $update_image_03 = $conn->prepare("UPDATE `products` SET image_03 = ? WHERE id = ?");
         $update_image_03->execute([$image_03, $pid]);
         move_uploaded_file($image_tmp_name_03, $image_folder_03);
         unlink('../uploaded_img/'.$old_image_03);
         $message[] = 'image 03 updated successfully!';
         $message_status[]='success';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update product</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/seller_style.css">

</head>
<body>

<?php include '../components/seller_header.php'; ?>

<section class="update-product">

   <h1 class="heading">update product</h1>

   <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image_01" value="<?= $fetch_products['image_01']; ?>">
      <input type="hidden" name="old_image_02" value="<?= $fetch_products['image_02']; ?>">
      <input type="hidden" name="old_image_03" value="<?= $fetch_products['image_03']; ?>">
      <div class="image-container">
         <div class="main-image">
            <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
         </div>
         <div class="sub-image">
            <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
            <img src="../uploaded_img/<?= $fetch_products['image_02']; ?>" alt="">
            <img src="../uploaded_img/<?= $fetch_products['image_03']; ?>" alt="">
         </div>
      </div>
      <span>update name</span>
      <input type="text" name="name" required class="box" maxlength="100" placeholder="enter product name" value="<?= $fetch_products['name']; ?>">
      <span>update price</span>
      <input type="number" name="price" required class="box" min="0" max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['price']; ?>">
      <span>update details</span>
      <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
      <span>update image 01</span>
      <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>update image 02</span>
      <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>update image 03</span>
      <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">

      <div class="inputBox">
            <span>Bedroom *</span>
            <input type="number"value="<?= $fetch_products['p_bedroom']; ?>" min="0" class="box" required max="9999999999" placeholder="How many Bedrooms" onkeypress="if(this.value.length == 10) return false;" name="bedroom">
         </div>

         <div class="inputBox">
            <span>Beds *</span>
            <input type="number"value="<?= $fetch_products['p_bed']; ?>" min="0" class="box" required max="9999999999" placeholder="How many Beds" onkeypress="if(this.value.length == 10) return false;" name="bed">
         </div>

         <div class="inputBox">
            <span>Bathrooms *</span>
            <input type="number"value="<?= $fetch_products['p_bath']; ?>" min="0" class="box" required max="9999999999" placeholder="How many Bathrooms" onkeypress="if(this.value.length == 10) return false;" name="bath">
         </div>

         <div class="inputBox">
            <span>Max Person limit *</span>
            <input type="number"value="<?= $fetch_products['p_person']; ?>" min="0" class="box" required max="9999999999" placeholder="enter person" onkeypress="if(this.value.length == 10) return false;" name="person">
         </div>
         
<!--
         <div class="inputBox">
            <span>Country *</span>
            <select name='country' value="<?=$fetch_products['p_country'] == 'room' ? ' selected="selected"' : '';?>"  class="country" size="1" onchange="loadStates();selectcountry(this);">
            <option   >-- Select Country --</option>
            </select>
            <span ><?php echo $fetch_products['p_country']; ?></span>
            </div>

            <div class="inputBox">
             </div>
            
            <div class="inputBox">
            <span>State *</span>
               <select name='state' class="state" size="1" onchange="loadCities();selectstate(this);">
               <option value="" selected="selected">-- Select State --</option>
               </select>
               <span ><?php echo $fetch_products['p_state']; ?></span>
            </div>

            <div class="inputBox">
             </div>

            <div class="inputBox">
            <span>City  *</span>
               <select class="city" size="1" name="city" onchange='selectcity(this);'>
               <option value="" selected="selected" >-- Select City --</option>
               </select>
               <span ><?php echo $fetch_products['p_city']; ?></span>
            </div>

            <div class="inputBox">
             </div>
         -->
            <div class="inputBox">
            <span>Address *</span>
            <textarea name="address"  placeholder="enter address" class="box" maxlength="500" cols="30" rows="10"><?php echo $fetch_products['details']; ?></textarea>
             </div>


      <div class="inputBox">
            <span>Category</span>
          
            <select name="category" value=""> 
               <option value="room"<?=$fetch_products['category'] == 'room' ? ' selected="selected"' : '';?>>room</option>
               <option value="beach"<?=$fetch_products['category'] == 'beach' ? ' selected="selected"' : '';?>>beach</option>
               <option value="city"<?=$fetch_products['category'] == 'city' ? ' selected="selected"' : '';?>>city</option>
               <option value="camping"<?=$fetch_products['category'] == 'camping' ? ' selected="selected"' : '';?>>camping</option>
               <option value="hill"<?=$fetch_products['category'] == 'hill' ? ' selected="selected"' : '';?>>hill</option>
               <option value="forest"<?=$fetch_products['category'] == 'forest' ? ' selected="selected"' : '';?>>forest</option>
               <option value="boat"<?=$fetch_products['category'] == 'boat' ? ' selected="selected"' : '';?>>boat</option>
               <option value="castle"<?=$fetch_products['category'] == 'castle' ? ' selected="selected"' : '';?>>castle</option>
               <option value="golf"<?=$fetch_products['category'] == 'golf' ? ' selected="selected"' : '';?>>golf</option>
               <option value="apartment"<?=$fetch_products['category'] == 'apartment' ? ' selected="selected"' : '';?>>apartment</option>
               <option value="tower"<?=$fetch_products['category'] == 'tower' ? ' selected="selected"' : '';?>>tower</option>
               </select>
         </div>


         <div class="inputBox">
            <span>During Guest Stay Facilities*</span>
            <input type="text" class="box"value="<?=$fetch_products['p_facility'];?>" required maxlength="100" placeholder="enter Facilities" name="facility">
         </div>
      <div class="flex-btn">
         <input type="submit" name="update" class="btn" value="update">
         <a href="products.php" class="btn">go back</a>
      </div>
     
   </form>
   
   <?php
         }
      }else{
         echo '<p class="empty">no product found!</p>';
      }
   ?>

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