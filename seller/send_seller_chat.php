<?php


include '../components/connect.php';

session_start();

$seller_id = $_SESSION['seller_id'];


if(!isset($seller_id)){
   header('location:seller_login.php');
}

if(isset($_GET['user_id']) && isset($_GET['chat_message']))
{
    $now = new DateTime();
    $now=$now->format('Y-m-d H:i'); 
    $user_id=$_GET['user_id'];
    $seller_message=$_GET['chat_message'];
    $customer='';
    $statement = $conn->prepare(" INSERT INTO `chat`(seller,seller_id,user_id,time,customer) VALUES(?,?,?,?,?)");
    $statement->execute([$seller_message,$seller_id,$user_id,$now,$customer]);
 echo $output;

}

?>



<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>