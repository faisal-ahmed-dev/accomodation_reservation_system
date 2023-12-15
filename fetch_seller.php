<?php

include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};



$query = "SELECT DISTINCT chat.seller_id,seller.name,MAX(chat.time) as time from chat,seller where chat.seller_id=seller.id  and user_id=$user_id GROUP BY chat.seller_id order by MAX(chat.time) DESC ";

$statement = $conn->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table table-bordered table-striped">
 <tr>
  <td>Host-id</td>
  <td class="chat">Host Name</td>
  <td class="chat">Last Message</td>
 </tr>
';

foreach($result as $row)
{
 $output .= '
 <tr>
  <td>'.$row['seller_id'].'</td>
  <td >'.$row['name'].'</td>
  <td >'.$row['time'].'</td>
  <td><button type="button" style="" class="btn btn_start_chat chat start_chat" data-tosellerid="'.$row['seller_id'].'" data-tousername="'.$row['name'].'">Start Chat</button></td>
  
  </tr>
 ';
}

$output .= '</table>';

echo $output;

?>