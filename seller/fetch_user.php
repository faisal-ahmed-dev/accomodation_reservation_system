<?php


include '../components/connect.php';

session_start();

$seller_id = $_SESSION['seller_id'];


if(!isset($seller_id)){
   header('location:seller_login.php');
}



$query = "SELECT DISTINCT chat.user_id,users.name,MAX(chat.time) as time from chat,users where chat.user_id=users.id  and seller_id=$seller_id GROUP BY chat.user_id  order by MAX(chat.time) DESC ";

$statement = $conn->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table table-bordered table-striped">
 <tr>
  <td>User-id</td>
  <td class="chat">User Name</td>
  <td class="chat">Last Message</td>
 </tr>
';

foreach($result as $row)
{
 $output .= '
 <tr>
  <td>'.$row['user_id'].'</td>
  <td >'.$row['name'].'</td>
  <td >'.$row['time'].'</td>
  <td><button type="button" style="" class="btn_start_chat chat start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['name'].'">Start Chat</button></td>
  
  </tr>
 ';
}

$output .= '</table>';

echo $output;

?>