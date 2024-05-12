<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>

   function sendEmail(to, subject, body)
   {
   
      
     
      Email.send({
    Host : "smtp.elasticemail.com",
    Username : "tourifyHelp@gmail.com",
    Password : "16BC356424993480F4657D1F1010B10895DC",
    To : to,
    From : "tourifyHelp@gmail.com",
    Subject : subject,
    Body : body
         }).then(  
         message => {
            if(message=='OK')
            {
               
               alert('mail send Successfully');
            }
            else{
                alert('mail send error');
            }
         }
         );
        
   }
     

</script>


<?php

include '../components/connect.php';

session_start();

$seller_id = $_SESSION['seller_id'];

if(!isset($seller_id)){
   header('location:seller_login.php');
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $pid = $_POST['pid'];

   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   if($_POST['payment_status']=='rejected')
   {
      $select_order = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
      $select_order->execute([$order_id]);
      if($select_order->rowCount() > 0){
         while($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)){
          
      echo '
      <script type="text/javascript">  const to= `'.$fetch_order['email'].'`;
   const subject = `Your Order at '.$fetch_order['place_name'].' is Rejected`;
   const body = `Your Order Has Been Placed <br><br>
   Dear '.$fetch_order['name'].',<br><br>

         We would to like to inform you that your Order at '.$fetch_order['place_name'].' is Rejected.<br><br>
         

         Sincerely,<br><br>

         Tourify<br><br>
      `;


   sendEmail(to, subject, body);</script>
';
      }
   }
}
else if($_POST['payment_status']=='completed')
{
   $select_order = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
   $select_order->execute([$order_id]);
   if($select_order->rowCount() > 0){
      while($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)){
       
         echo '
         <script type="text/javascript">  const to= `'.$fetch_order['email'].'`;
      const subject = `Your Order at '.$fetch_order['place_name'].' is Confirmed`;
      const body = `Your Order Has Been Placed <br><br>
      Dear '.$fetch_order['name'].',<br><br>

            We are pleased to inform you that your Order placed on '.$fetch_order['placed_on'].' at '.$fetch_order['place_name'].' is Confirmed.<br><br>

            Mobile Number : '.$fetch_order['number'].'<br><br>

            Your check-in : '.$fetch_order['checkin'].'<br><br>

            Your checkout : '.$fetch_order['checkout'].'<br><br>

            
            Payment: $'.$fetch_order['total_price'].' <br><br>
            
   

            Sincerely awaiting your visit,<br><br>

            Tourify<br><br>
         `;

   
      sendEmail(to, subject, body);</script>
';




   }
}
}
   $message[] = 'payment status updated!';
   $message_status[]='success';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>placed orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/seller_style.css">

</head>
<body>

<?php include '../components/seller_header.php'; ?>

<section class="orders">

<h1 class="heading">placed orders</h1>

<div class="box-containers">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` Where seller_id=? order by placed_on DESC " );
      $select_orders->execute([$seller_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="boxs">
   <table class="table table-bordered table-striped">
      <tr>
      <td>placed on</td>
      <td>Order id</td>
      <td>Customer name</td>
      <td>Place id</td>
      <td>Place name </td>
      <td>number</td>
      <td>address</td>
      <td>checkin</td>
      <td>checkout</td>
      <td>Price</td>
      <td>Card Number</td>
      <td>Payment Status</td>
      </tr>
      <tr>
         <td><?= $fetch_orders['placed_on']; ?></td>
         <td><?= $fetch_orders['id']; ?></td>
         <td><?= $fetch_orders['name']; ?></td>
         <td><?= $fetch_orders['pid']; ?></td>
         <td><?= $fetch_orders['place_name']; ?></td>
         <td><?= $fetch_orders['number']; ?></td>
         <td><?= $fetch_orders['address']; ?></td>
         <td><?= $fetch_orders['checkin']; ?></td>
         <td><?= $fetch_orders['checkout']; ?></td>
         <td><?= $fetch_orders['total_price']; ?></td>
         <td><?= $fetch_orders['cardnumber']; ?></td>
         <td><form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <input type="hidden" name="pid" value="<?= $fetch_orders['pid']; ?>">

                 <select id="paymentStatusSelect" name="payment_status" class="select" >
                     <?php
                     $paymentOptions = ['rejected', 'completed'];

                     $fetchedPaymentStatus = strtolower($fetch_orders['payment_status']);

                     echo '<option selected disabled>' . ucfirst($fetchedPaymentStatus) . '</option>';

                     foreach ($paymentOptions as $option) {
                         if ($option === $fetchedPaymentStatus) {
                             continue; // Skip this iteration
                         }
                         echo '<option value="' . $option . '">' . ucfirst($option) . '</option>';
                     }
                     ?>
                 </select>
        <div class="flex-btn">
         <input type="submit" value="update" class="option-btn" name="update_payment" >
        </div>
      </form></td>
   </tr>
 </table>
 <!--
      <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
       <p> Order id : <span><?= $fetch_orders['id']; ?></span> </p>
      <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> Place name : <span><?= $fetch_orders['place_name']; ?></span> </p>
      <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> Price : <span>$<?= $fetch_orders['total_price']; ?></span> </p>
      <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="payment_status" class="select">
            <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
            <option value="pending">pending</option>
            <option value="rejected">rejected</option>
            <option value="completed">completed</option>
         </select>
        <div class="flex-btn">
         <input type="submit" value="update" class="option-btn" name="update_payment">
         <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
        </div>
      </form>
         -->
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
   ?>

</div>

</section>

</section>









<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="../js/seller_script.js"></script>
   
</body>
</html>