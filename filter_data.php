<?php

    if(isset($_GET['limit']) && isset($_GET['start']) )
    {
        $categoryselect=$_GET['categoryselect'];
        $min = $_GET['min'];
        $max = $_GET['max'];
        
        $user_name = 'root';
        $user_password = '';
        
        $conn = mysqli_connect('localhost', $user_name, $user_password,'airbnb');
        $sql= " SELECT p.* FROM products p LEFT JOIN orders o ON p.id = o.pid WHERE  p.category='$categoryselect' and p.price between $min and $max  ";
       
        
        $limit= $_GET['limit'];
        $start= $_GET['start'];
        $bedroom = $_GET['bedroom'];
        $bed = $_GET['bed'];
        $bath = $_GET['bath'];
        $country = $_GET['country'];
        $state = $_GET['state'];
        $city = $_GET['city'];
        $checkin=$_GET['checkin'];
        $checkout=$_GET['checkout'];
       
        if($checkin!=null && $checkin!='' )
        {
            $sql.= " and o.pid IS NULL OR ('$checkin' NOT BETWEEN o.checkin AND o.checkout) ";
        }
       
         if($checkout!=null && $checkout!='' )
        {
            $sql.= " and o.pid IS NULL OR ('$checkout' NOT BETWEEN o.checkin AND o.checkout) ";
        }

       

        if($bedroom!=null && $bedroom>0)
        {
            
            $sql.="and p.p_bedroom=$bedroom ";
        }
        if($bed!=null && $bed>0)
        {
            
            $sql.="and p.p_bed=$bed ";
        }
        if($bath!=null && $bath>0)
        {
          
            $sql.="and p.p_bath=$bath ";
        }
        if($country!=null && $country!='-- Select Country --')
        {
            $sql.= "and p.p_country='$country' ";
        }
        if($state!=null && $state!='-- Select State --' && $state!='Select State')
        {
            $sql.= "and p.p_state='$state' ";
        }
        if($city!=null && $city!='-- Select City --'  && $city!='Select City')
        {
            $sql.= "and p.p_city='$city' ";
        }



        $sql.=" and p.p_status<>'Booked' limit $start,$limit";
        

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