<?php

include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quick view</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.0/moment.min.js"></script>
   
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="quick-view">

   <h1  class="heading">quick view</h1>

   <?php
     $pid = $_GET['pid'];
     $select_products = $conn->prepare("SELECT products.id,products.name,products.price,products.image_01,products.image_02,products.image_03,products.category,products.details,products.p_person,products.p_bedroom,products.p_bed,products.p_bath,products.p_checkin,products.p_checkout,products.p_country,products.p_state,products.p_city as city,products.p_facility,seller.id as seller_id,seller.name as seller_name,seller.email as seller_email,seller.phone as seller_phone,seller.f_language,seller.s_language,seller.description as seller_desc FROM `products`,`seller` WHERE products.seller_id=seller.id and products.id = ?"); 
     $select_products->execute([$pid]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <input type="hidden" name="seller_id" value="<?= $fetch_product['seller_id']; ?>">
      
      <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
            </div>
            <div class="sub-image">
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
               <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="">
               <img src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="">
            </div>
         </div>
         <div class="content">
          
            <div class="flex">
            <div class="name "><?= $fetch_product['name']; ?> </div>
               
               <div class="card">
                  <p class="title"><span>$</span><span id='price'><?= $fetch_product['price']; ?></span><span> Per Night</span></p>
                  </div>
                  


              </div>
              <div class="details"><?= $fetch_product['details']; ?></div>
              <div class="flex-btn room ">
            <div class="span"><i class="fa-solid fa-person"></i><?= $fetch_product['p_person']; ?> Person </div>   
            <div class="span"><i class="fa-solid fa-person-shelter"></i><?= $fetch_product['p_bedroom']; ?> Bedroom </div>
            <div class="span"><i class="fa-solid fa-bed"></i><?= $fetch_product['p_bed']; ?> Bed</div>
            <div class="span"><i class="fa-solid fa-restroom"></i><?= $fetch_product['p_bath']; ?> Restroom </div>
           
         </div>
            <div class="flex-btn check">
            <div class="span " >Check-in <span class="material-symbols-outlined">login</span><input id="checkin" class="checkin"name="checkin" type="text" autocomplete="off"></input> <p id="clear"><i class="fa-solid fa-xmark fa-xl"></i></p> </div>
            <div class="span " >Check-out<span class="material-symbols-outlined">logout</span><input id="checkout" class="checkout" name="checkout" type="text" autocomplete="off"></input>  </div>   
           
            </div>
            <div class="">
               <div><span id="info" class="info ">Please Provide Checkin & Checkout</span></div>
            </div>

            <div class="flex-btn ">
            <input type="submit" value="reserve" class="btn" name="add_to_cart"></input>
               <input class="option-btn" type="submit" name="add_to_wishlist" value="add to wishlist">
            </div>
          

         </div>


<div class="container_weather flex-btn_weather">
        <div class="weather-side">
            <div class="weather-gradient"></div>
            <div class="flex-btn">
               <div class="date-container">
                  <h2 class="date-dayname"></h2>
                  <span class="date-day"></span>
                  <i class="fa-solid fa-location-dot"></i>
                  <span class="location"></span>
               </div>
               <div class="weather-container">
                  <span class="weather-icon"></span>
                  <h1 class="weather-temp"></h1>
                  <h3 class="weather-desc"></h3>
               </div>
            </div>
        </div>
        <div class="info-side">
            <div class="today-info-container">
                <div class="today-info">
                    <div class="humidity">
                        <span class="title"><i class="fa-solid fa-droplet"></i> HUMIDITY</span>
                        <span class="value"></span>
                        <div class="clear"></div>
                    </div>
                    <div class="wind">
                        <span class="title"><i class="fa-solid fa-wind"></i> WIND</span>
                        <span class="value"></span>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="week-container">
                <ul class="week-list">
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="location-container">
                
                <input class="location-input" type="text" id="city" value="<?= $fetch_product['city']; ?>" hidden>
            </div>
        </div>

    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
         <div class="content seller">
            <h3>Host</h3>
            <div class="flex">
            <div class="name ">Hi, I Am <span><?= $fetch_product['seller_name']; ?></span></div>


              </div>
              <h2>Description</h2>
              <div class="details"><?= $fetch_product['seller_desc']; ?></div>
              <div class="details facility"><span>Facility</span>  <p><?= $fetch_product['p_facility']; ?></p></div>
              <div class="details language"><span>Language</span>  <p><?= $fetch_product['f_language']; ?> <?= $fetch_product['s_language']; ?></p> </div>
             
            
    
         </div>

         
         <div class="wrapper_chat" id='wrapper_chat'>
        <div class="title">Talk to <span><?= $fetch_product['seller_name']; ?></span></div>
        <div class="form_chat">
         <h3 id='login'>Log in to Chat</h3>
            <div class="bot-inbox inbox">
                <div class="msg-header">
                    
                    
                </div>
            </div>
            
        </div>
        <div class="typing-field">
        <span id='reload'><i class="fa-solid fa-rotate"></i></span>
            <div class="input-data">
                <input onkeyup="sendbtn()" id="data" type="text" placeholder="Type something here.." >
                <span id="send-btn" disabled>Send</span>
            </div>
        </div>
        
    </div>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
<script src="js/weather.js"></script>


    <script>
    function sendbtn() {
	 if(document.getElementById("data").value==="") { 
      $("#send-btn").css('display','none');
        } else { 
         $("#send-btn").css('display','block');
        }
    }

    
 
    $("#clear").on('click', function() {
     
      $('#clear').attr('class', 'disabled');
       $("#checkout").prop('disabled', true);
       $("#checkout").val('');
       $("#checkin").val('');
       window.location.reload();


  });
   

   
   
   
    <?php 

         $totaldayslist='';

      $select_orders = $conn->prepare("SELECT * FROM `orders` Where pid=? and payment_status <> 'rejected' " );
      $select_orders->execute([$pid]);
      if($select_orders->rowCount() > 0){
         while($row = $select_orders->fetch(PDO::FETCH_ASSOC)){

                   $start = strtotime($row['checkin']);
                  $end = strtotime($row['checkout'])-1;
                  for ($i=$start; $i<=$end; $i+=86400) { 
                  $dateslistselect[]= '"'.date('d-m-Y',$i).'"';   
                  }          
                  }
                  $dateslistselect=array_filter($dateslistselect);
                  $totaldayslist =implode(", ", $dateslistselect);  

         
      }
      
    ?>
    var unavailableDates = [<?php echo $totaldayslist;?>];
      console.log(<?php echo $totaldayslist;?>);
    var dateToday= new Date();
function unavailable(date) {
  
    dmy =   date.getDate()+ "-" + (date.getMonth() + 1) + "-" +date.getFullYear();
    if ($.inArray(dmy, unavailableDates) == -1) {
        return [true, ""];
    } else {
        return [false, "", "Unavailable"];
    }
}

function parseDate(dateString) {
    var parts = dateString.split("-");
    return new Date("20" + parts[2], parts[1] - 1, parts[0]);
}
function datediff(first, second) {        
    return Math.round((second - first) / (1000 * 60 * 60 * 24));
}


if(unavailableDates!=null)
{
var dates= $("#checkin,#checkout").datepicker({
   dateFormat: 'dd-mm-yy',
   maxDate: "3m+",
   changeMonth:true,
   numberOfMonths:1,
   minDate:dateToday,
   beforeShowDay: function(date){
      var dateString = $.datepicker.formatDate('dd-mm-yy', date);
          return [unavailableDates.indexOf(dateString) === -1];
   },
   onSelect:function(selectedDate){
      var option=this.id=="checkin" ? "minDate" :"maxDate",
      instance= $(this).data("datepicker"),
    date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
    date.setDate(date.getDate() + 1);
         dates.not(this).datepicker("option",option,date);
        
         var maxDate='3m+';
         for(let i=0;i<unavailableDates.length;i++)
         {
            var date1 = parseDate(selectedDate);
            var date2 = parseDate(unavailableDates[i]);
         
            var diff = datediff(date1,date2);
            if(diff>-1)
            {
               maxDate=unavailableDates[i];
              console.log(maxDate);
               break;
            }
         }
         
            dates.not(this).datepicker("option", "maxDate",maxDate);
            $("#checkout").prop('disabled', false);
            $('#clear').attr('class', '');
            var inn= $('[id="checkin"]').val();
            var out=$('[id="checkout"]').val();
            if(inn!='' && out!='')
               { 
                  
                  var dayDiff =datediff(parseDate(inn), parseDate(out));
                  var price=document.getElementById("price").innerHTML;
                  var totalprice=dayDiff*price;
                  document.getElementById("info").innerHTML=dayDiff+" Nights x $"+price+"  = $"+totalprice;
                  var priceInput = document.querySelector('input[name="price"]');
                  priceInput.value = totalprice; 

               }
   }
   
});
}
else{

var dates= $("#checkin,#checkout").datepicker({
   dateFormat: 'dd-mm-yy',
   gotoCurrent: true,
   defaultDate:"1+w",
   maxDate: "3m+",
   changeMonth:true,
   numberOfMonths:1,
   minDate:dateToday,
   onSelect:function(selectedDate){
      var option=this.id=="checkin" ? "minDate" :"maxDate",
      instance= $(this).data("datepicker"),
    date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
    date.setDate(date.getDate() + 1);
         dates.not(this).datepicker("option",option,date);   
         $("#checkout").prop('disabled', false);
         $('#clear').attr('class', '');
         var inn= $('[id="checkin"]').val();
            var out=$('[id="checkout"]').val();
            if(inn!='' && out!='')
               { 
                  
                  var dayDiff =datediff(parseDate(inn), parseDate(out));
                  var price=document.getElementById("price").innerHTML;
                  var totalprice=dayDiff*price;
                  document.getElementById("info").innerHTML=dayDiff+" Nights x $"+price+"  = $"+totalprice;
                  var priceInput = document.querySelector('input[name="price"]');
                  priceInput.value = totalprice; 
               }
   }
   
});
}






        $(document).ready(function(){
         
         $('#clear').attr('class', 'disabled');
         $("#checkout").prop('disabled', true);
          var user_id = '<?php echo $user_id; ?>';
          var seller_id='<?php echo  $fetch_product['seller_id']; ?>';
          $(".form_chat").animate({ scrollTop: 20000000 }, "slow");
          if(user_id!='')
          {
            $("#login").css('display','none');
         load_data();
         $("#reload").on("click", function(){
                           $(".form_chat").html('');
                        load_data();   
                     }); 
         function load_data(){
            $.ajax({
               url: '/api/message.php',
               type:'get',
               data : {
                     user_id:user_id,
                     seller_id:seller_id
               },
               dataType:'json',
               success:function(result){
                  if(result.status==1)
                  {
                    
                     const data=result.data;
                    
                    
                     $.each(data,function(index,text){
                       
                      
                        if(text['seller']!='')
                        {
                           
                           $replay = '<div class="bot-inbox inbox seller"><div class="icon"><i class="fa-solid fa-user-tie"></i></div><div class="msg-header"><p>'+ text['seller'] +'</p></div></div>';
                        $(".form_chat").append($replay);
                  
                        }
                        else{
                           $replay = '<div class="bot-inbox inbox customer"><div class="msg-header"><p>'+ text['customer'] +'</p></div><div class="icon"><i class="fas fa-user"></i></div></div>';
                        $(".form_chat").append($replay);
                        $(".form_chat").animate({ scrollTop: 20000000 }, "slow");
                        }

                        

                     });
                   
                  }
                  else{
                     $("#login").css('display','block');
                     $("#login").text('Say Hello');
                    
                     
                  }
                  
               }
            })
         }
      
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                
                $.ajax({
                    url: '/api/send_message.php',
                    type: 'get',
                    data : {
                     text:$value,
                     user_id:user_id,
                     seller_id:seller_id
               },
                    success: function(result){
                     $replay = '<div class="bot-inbox inbox customer"><div class="msg-header"><p>'+ $value +'</p></div><div class="icon"><i class="fas fa-user"></i></div></div>';
                        $(".form_chat").append($replay);
                        
                    }
                });
            });
         }
         else{
            $("#login").css('display','block');
            $("#send-btn").css('display','none');
            $("#data").prop('disabled', true);
         }
        });
    </script>
    </div>

      </div>
   </form>
   <script>
 document.getElementById("checkin").innerHTML = moment('<?=$fetch_product['p_checkin']?>', 'DD-MM-YYYY').format('MMM D Y');
 document.getElementById("checkout").innerHTML = moment('<?=$fetch_product['p_checkout']?>', 'DD-MM-YYYY').format('MMM D Y');
</script>

   <?php
      
      }
   }else{
      echo '<p class="empty">no places added yet!</p>';
   }
   ?>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>



</body>
</html>