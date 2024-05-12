

<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['order'])){
   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $place_name = $_POST['place_name'];
   $place_name = filter_var($place_name, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $address =  $_POST['flat'] .', '. $_POST['city'] .','. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_price = $_POST['total_price'];
   $checkin = $_POST['checkin'];
   $checkin = filter_var($checkin, FILTER_SANITIZE_STRING);
   $checkout = $_POST['checkout'];
   $checkout = filter_var($checkout, FILTER_SANITIZE_STRING);
   $payment_name = $_POST['payment_name'];
   $payment_name = filter_var($payment_name, FILTER_SANITIZE_STRING);
   $cardnumber = $_POST['cardnumber'];
   $cardnumber = filter_var($cardnumber, FILTER_SANITIZE_STRING);

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);
   $row = $check_cart->fetch(PDO::FETCH_ASSOC);

   if($check_cart->rowCount() > 0){
      $seller_id=$row['seller_id'];
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address,  total_price,seller_id,pid,place_name,checkin,checkout,payment_name,cardnumber) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, "", $address, $total_price,$seller_id,$pid,$place_name,$checkin,$checkout,$payment_name,$cardnumber]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$pid]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
          

     echo '
             <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script>
        function sendEmail(to, subject, body) {
            Email.send({
                Host: "smtp.elasticemail.com",
                Username: "tourifyHelp@gmail.com",
                Password: "16BC356424993480F4657D1F1010B10895DC",
                To: to,
                From: "tourifyHelp@gmail.com",
                Subject: subject,
                Body: body
            }).then(function(message) {
                if (message === "OK") {
                     window.location.href = "orders.php";
                } else {
                    alert("Failed to send email. Please try again later.");
                }
            });
        }

        // Call sendEmail function with dynamic parameters
        const to = "'.$email.'";
        const subject = "Your Order at '.$place_name.' is Pending";
        const body = `Your Order Has Been Placed <br><br>
            Dear '.$name.',<br><br>
            We are pleased to inform you that your Order at '.$place_name.' is Pending.<br><br>
            Mobile Number: '.$number.'<br><br>
            Your check-in: '.$checkin.'<br>
            Your checkout: '.$checkout.'<br>
            Reservation details:<br><br>
            Accommodation Type: '.$fetch_products['category'].'<br>
            Person: '.$fetch_products['p_person'].'<br>
            Bedroom: '.$fetch_products['p_bedroom'].'<br>
            Bed: '.$fetch_products['p_bed'].'<br>
            Bath: '.$fetch_products['p_bath'].'<br>
            Payment: $'.$total_price.' <br><br>
            Sincerely awaiting your visit,<br><br>
            Tourify<br><br>`;
            
        sendEmail(to, subject, body);
    </script>
    ';
         }
      }
      $message[] = 'order placed successfully!';
      $message_status[]='success';

   }else{
      $message[] = 'No Reserve';
      $message_status[]='warning';
   }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST" name='checkout-form' onsubmit="return validateForm() && validatePhone();">

   <h3>place your orders</h3>

      <div class="display-orders">
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price']);
               $place_name=$fetch_cart['name'];
               
      ?>
      <div class="flex">
       <div class="grand-total">Place name: <span><?= $place_name; ?></span></div>
       <div class="grand-total">Checkin: <span><?= $fetch_cart['checkin']; ?></span></div>
       <div class="grand-total">Checkout: <span><?= $fetch_cart['checkout']; ?></span></div>
       <div class="grand-total">Price : <span>$<?= $grand_total; ?></span></div>
       </div>
       <input type="hidden" name="pid" value="<?= $fetch_cart['pid']; ?>">
       <input type="hidden" name="place_name" value="<?=  $place_name; ?>">
       <input type="hidden" name="checkin" value="<?= $fetch_cart['checkin']; ?>">
       <input type="hidden" name="checkout" value="<?= $fetch_cart['checkout']; ?>">
      <?php
            }
         }else{
            echo '<p class="empty">your cart is empty!</p>';
         }
      ?>
         
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
        
        
      </div>

      

      <div class="flex">
         <div class="inputBox">
            <span>your name </span>
            <input type="text" name="name" id="name" maxlength="20"  placeholder="enter your name" class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>your number </span>
            <input type="number" name="number" id="number"  class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 11) return false;" required>
         </div>
         <div class="inputBox">
            <span>your email </span>
            <input type="email" name="email" placeholder="enter your email" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>address</span>
            <input type="text" name="flat" placeholder="e.g. Address" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>city </span>
            <input type="text" name="city" placeholder="e.g. Dhaka" class="box" maxlength="50" required>
         </div>

         <div class="inputBox">
            <span>country </span>
            <input type="text" name="country" placeholder="e.g. Bangladesh" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>postal code </span>
            <input type="number" min="0" name="pin_code" placeholder="e.g. 123456" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
         </div>
      </div>

<div class="payment">
         
<div class="container preload">
   <div class="creditcard">
         <div class="front">
            <div id="ccsingle"></div>
            <svg version="1.1" id="cardfront" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
               x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
               <g id="Front">
                     <g id="CardBackground">
                        <g id="Page-1_1_">
                           <g id="amex_1_">
                                 <path id="Rectangle-1_1_" class="lightcolor grey" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                        C0,17.9,17.9,0,40,0z" />
                           </g>
                        </g>
                        <path class="darkcolor greydark" d="M750,431V193.2c-217.6-57.5-556.4-13.5-750,24.9V431c0,22.1,17.9,40,40,40h670C732.1,471,750,453.1,750,431z" />
                     </g>
                     <text transform="matrix(1 0 0 1 60.106 295.0121)" id="svgnumber" class="st2 st3 st4">0123 4567 8910 1112</text>
                     <text transform="matrix(1 0 0 1 54.1064 428.1723)" id="svgname" class="st2 st5 st6">JOHN DOE</text>
                     <text transform="matrix(1 0 0 1 54.1074 389.8793)" class="st7 st5 st8">cardholder name</text>
                     <text transform="matrix(1 0 0 1 479.7754 388.8793)" class="st7 st5 st8">expiration</text>
                     <text transform="matrix(1 0 0 1 65.1054 241.5)" class="st7 st5 st8">card number</text>
                     <g>
                        <text transform="matrix(1 0 0 1 574.4219 433.8095)" id="svgexpire" class="st2 st5 st9">01/23</text>
                        <text transform="matrix(1 0 0 1 479.3848 417.0097)" class="st2 st10 st11">VALID</text>
                        <text transform="matrix(1 0 0 1 479.3848 435.6762)" class="st2 st10 st11">THRU</text>
                        <polygon class="st2" points="554.5,421 540.4,414.2 540.4,427.9 		" />
                     </g>
                     <g id="cchip">
                        <g>
                           <path class="st2" d="M168.1,143.6H82.9c-10.2,0-18.5-8.3-18.5-18.5V74.9c0-10.2,8.3-18.5,18.5-18.5h85.3
                     c10.2,0,18.5,8.3,18.5,18.5v50.2C186.6,135.3,178.3,143.6,168.1,143.6z" />
                        </g>
                        <g>
                           <g>
                                 <rect x="82" y="70" class="st12" width="1.5" height="60" />
                           </g>
                           <g>
                                 <rect x="167.4" y="70" class="st12" width="1.5" height="60" />
                           </g>
                           <g>
                                 <path class="st12" d="M125.5,130.8c-10.2,0-18.5-8.3-18.5-18.5c0-4.6,1.7-8.9,4.7-12.3c-3-3.4-4.7-7.7-4.7-12.3
                        c0-10.2,8.3-18.5,18.5-18.5s18.5,8.3,18.5,18.5c0,4.6-1.7,8.9-4.7,12.3c3,3.4,4.7,7.7,4.7,12.3
                        C143.9,122.5,135.7,130.8,125.5,130.8z M125.5,70.8c-9.3,0-16.9,7.6-16.9,16.9c0,4.4,1.7,8.6,4.8,11.8l0.5,0.5l-0.5,0.5
                        c-3.1,3.2-4.8,7.4-4.8,11.8c0,9.3,7.6,16.9,16.9,16.9s16.9-7.6,16.9-16.9c0-4.4-1.7-8.6-4.8-11.8l-0.5-0.5l0.5-0.5
                        c3.1-3.2,4.8-7.4,4.8-11.8C142.4,78.4,134.8,70.8,125.5,70.8z" />
                           </g>
                           <g>
                                 <rect x="82.8" y="82.1" class="st12" width="25.8" height="1.5" />
                           </g>
                           <g>
                                 <rect x="82.8" y="117.9" class="st12" width="26.1" height="1.5" />
                           </g>
                           <g>
                                 <rect x="142.4" y="82.1" class="st12" width="25.8" height="1.5" />
                           </g>
                           <g>
                                 <rect x="142" y="117.9" class="st12" width="26.2" height="1.5" />
                           </g>
                        </g>
                     </g>
               </g>
               <g id="Back">
               </g>
            </svg>
         </div>
         <div class="back">
            <svg version="1.1" id="cardback" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
               x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
               <g id="Front">
                     <line class="st0" x1="35.3" y1="10.4" x2="36.7" y2="11" />
               </g>
               <g id="Back">
                     <g id="Page-1_2_">
                        <g id="amex_2_">
                           <path id="Rectangle-1_2_" class="darkcolor greydark" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                     C0,17.9,17.9,0,40,0z" />
                        </g>
                     </g>
                     <rect y="61.6" class="st2" width="750" height="78" />
                     <g>
                        <path class="st3" d="M701.1,249.1H48.9c-3.3,0-6-2.7-6-6v-52.5c0-3.3,2.7-6,6-6h652.1c3.3,0,6,2.7,6,6v52.5
               C707.1,246.4,704.4,249.1,701.1,249.1z" />
                        <rect x="42.9" y="198.6" class="st4" width="664.1" height="10.5" />
                        <rect x="42.9" y="224.5" class="st4" width="664.1" height="10.5" />
                        <path class="st5" d="M701.1,184.6H618h-8h-10v64.5h10h8h83.1c3.3,0,6-2.7,6-6v-52.5C707.1,187.3,704.4,184.6,701.1,184.6z" />
                     </g>
                     <text transform="matrix(1 0 0 1 621.999 227.2734)" id="svgsecurity" class="st6 st7">985</text>
                     <g class="st8">
                        <text transform="matrix(1 0 0 1 518.083 280.0879)" class="st9 st6 st10">security code</text>
                     </g>
                     <rect x="58.1" y="378.6" class="st11" width="375.5" height="13.5" />
                     <rect x="58.1" y="405.6" class="st11" width="421.7" height="13.5" />
                     <text transform="matrix(1 0 0 1 59.5073 228.6099)" id="svgnameback" class="st12 st13">John Doe</text>
               </g>
            </svg>
         </div>
   </div>
</div>
<div class="form-container">
   <div class="field-container">
         <label for="name">Name</label>
         <input id="payment_name" name="payment_name" maxlength="20" type="text">
   </div>
   <div class="field-container">
         <label for="cardnumber">Card Number</label><span id="generatecard">generate random</span>
         <input id="cardnumber" name="cardnumber" type="text"  inputmode="numeric">
         <svg id="ccicon" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">

         </svg>
   </div>
   <div class="field-container">
         <label for="expirationdate">Expiration (mm/yy)</label>
         <input id="expirationdate" name="expirationdate" type="text"  inputmode="numeric">
   </div>
   <div class="field-container">
         <label for="securitycode">Security Code</label>
         <input id="securitycode" type="text" inputmode="numeric">
   </div>
</div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js'></script><script  src="./script.js"></script>


      <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="place order">

   </form>

</section>

<script>

</script>

<script>

function validateForm()
    {
        var x=document.getElementById('name').value;
        var spacepos=x.indexOf(" ");
        var numbers=/^[0-9]+$/;
        var n=x.split("  ");

        console.log(x);

         var iChars = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?0123456789";
             for (var i = 0; i < x.length; i++) 
             {
               if ((iChars.indexOf(x.charAt(i)) != -1)) 
               {

                 
               
                           Swal.fire({
                        icon: "warning", 
                        html: "Enter A Valid Name",  
                        showCloseButton: true,
                        background: 'white'
                        } );
         
                
               return false;
               }     
             }
             var alphabets=/^[a-zA-Z]+$/;

             if((n[0].match(alphabets) && spacepos>0))

             {
               Swal.fire({
                        icon: "warning", 
                        html: "Please Check Name Spaces",  
                        showCloseButton: true,
                        background: 'white'
                        } );
                        return false;
             }

          


            else if((x.match(alphabets)|| spacepos>0)) 
            {   
                
              return true;
            }

        else{
         Swal.fire({
                        icon: "warning", 
                        html: "Enter A Valid Name",  
                        showCloseButton: true,
                        background: 'white'
                        } );
               return false;
            }

          

       




          
    }



</script>

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<script>
  const input = document.querySelector("#number");

  const iti= window.intlTelInput(input, {
   initialCountry: "BD",
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
  });
function validatePhone()
{
  const isValid = iti.isValidNumber();
  if(isValid)
  {
   return true;
  }
  else{
   Swal.fire({
                        icon: "warning", 
                        html: "Enter A valid Number",  
                        showCloseButton: true,
                        background: 'white'
                        } );
   return false;
  }
}
</script>









<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>
<script src="sweetalert2.min.js"></script>
<script src="sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="@sweetalert2/themes/dark/dark.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/payement_script.js"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>
</body>
</html>