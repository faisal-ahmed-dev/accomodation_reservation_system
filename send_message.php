<?php
include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

    if(isset($_GET['text']) && isset($_GET['seller_id']))
    {
       
        $customer=$_GET['text'];
        $seller_id=$_GET['seller_id'];
        $now = new DateTime();
        $now=$now->format('Y-m-d H:i'); 
        $seller="";
        

        $sql= $conn->prepare("insert into chat(customer,seller_id,user_id,seller,time) values(?,?,?,?,?)");
        $sql->execute([$customer,$seller_id,$user_id,$seller,$now]);

        $message[] = 'message send successfully!';
        $message_status[]='success';


            


       
    

       
    }
    else{
       
    }
   
    
    
    
?>