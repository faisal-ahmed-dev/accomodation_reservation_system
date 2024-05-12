<?php


include '../components/connect.php';

session_start();

$seller_id = $_SESSION['seller_id'];


if(!isset($seller_id)){
   header('location:seller_login.php');
}

if(isset($_GET['user_id']) )
{
    $user_id=$_GET['user_id'];
    $seller_id=$_GET['seller_id'];
 $query = " select * from chat where seller_id=$seller_id and user_id=$user_id";
 $statement = $conn->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
   if($row["customer"]!='')
   {
  $output .= '
  <li >
   <p style="color: #fff;
   width: fit-content;
   background: black;
   border-radius: 10px;
   padding: 8px 10px;
   font-size: 14px;
   word-break:normal;" class="customer">'.$row["customer"].'</p>
  </li>
  ';
   }
   else{
      $output .= '
  <li style="display: flex;justify-content: flex-end;">
   <p style=" align-items: baseline; color: #fff;
   width: fit-content;
   margin-left: 16rem;
   background: black;
   border-radius: 10px;
   padding: 8px 10px;
   font-size: 14px;
   word-break:normal;"class="seller">'.$row["seller"].'</p>
  </li>
  ';
   }
 }

 echo $output;

}

?>