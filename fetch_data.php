<?php

    if(isset($_GET['limit']) && isset($_GET['start']) )
    {


        $limit= $_GET['limit'];
        $start= $_GET['start'];
        $categoryselect=$_GET['categoryselect'];
        if(isset($_GET['min']) && isset($_GET['max']) )
        {
            $minprice = $_GET['min'];
            $maxprice = $_GET['max'];
            

            
        }

        $user_name = 'root';
        $user_password = '';
        
        $conn = mysqli_connect('localhost', $user_name, $user_password,'airbnb');
        $sql= "select * from products where category='$categoryselect' and p_status<>'Booked' limit $start,$limit";
        $result= mysqli_query($conn,$sql);
    
        if($result->num_rows >0)
    {
       $out=array();
       $out['status']=1;
       while($row = $result->fetch_array())
       {    
        $out['data'][]= array(
            'id'=>$row['id'],
            'name'=>$row['name'],
            'city'=>$row['p_city'],
            'country'=>$row['p_country'],
            'state'=>$row['p_state'],
            'details'=>$row['details'],
            'price'=>$row['price'],
            'checkin'=>$row['p_checkin'],
            'checkout'=>$row['p_checkout'],
            'address'=>$row['p_address'],
            'seller'=>$row['seller_id'],
            'bedroom'=>$row['p_bedroom'],
            'bed'=>$row['p_bed'],
            'bath'=>$row['p_bath'],
            'image_01'=>$row['image_01'],
            'image_02'=>$row['image_02'],
            'image_03'=>$row['image_03'],
            'category'=>$row['category'],
        );

       }
    }
    else{
        $out['status']=0;
    }
    echo json_encode($out);
    }
    
?>