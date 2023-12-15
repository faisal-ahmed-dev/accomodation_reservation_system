
<?php

if(isset($_GET['user_id'])&& isset($_GET['seller_id']))
{

    $user_id=$_GET['user_id'];
    $seller_id=$_GET['seller_id'];
$user_name = 'root';
$user_password = '';
$conn = mysqli_connect('localhost', $user_name, $user_password,'airbnb');
$sql = "select * from chat where user_id=$user_id and seller_id=$seller_id";
$result = mysqli_query($conn, $sql) ;

if($result->num_rows >0)
{
   $out=array();
   
   $out['status']=1;
   while($row = $result->fetch_array())
   {    
    $out['data'][]= array(
        'c_id'=>$row['c_id'],
        'customer'=>$row['customer'],
        'seller'=>$row['seller']
       
    );
   
   }
}
else{
    $out['status']=0;
}
echo json_encode($out);
}
else{
    echo "<script>console.log('no')</script>";
}

?>

