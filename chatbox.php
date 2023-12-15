<?php

include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
    header('location:user_login.php');
};

?>


<!DOCTYPE html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Inbox</title>
   
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

<section class="contacts" >

<h1 class="heading">messages</h1>

<div class="box-container" style="height:100vh">
<div class="table-responsive">
<div id="user_details"></div>
<div id="user_model_details"></div>
</div>
</div>

</section>


<?php include 'components/footer.php'; ?>











   
</body>
</html>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="js/script.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script>  
$(document).ready(function(){

 fetch_user();

 function fetch_user()
 {
  $.ajax({
   url:"fetch_seller.php",
   method:"POST",
   success:function(data){
    $('#user_details').html(data);
   }
  })
 }
 

 function make_chat_dialog_box(to_seller_id, to_user_name)
 {
  var modal_content = '<div id="user_dialog_'+to_seller_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';
  modal_content += '<div style="height:210px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_seller_id+'" id="chat_history_'+to_seller_id+'">';
  modal_content += '</div>';
  modal_content += '<span style="margin-left: 1rem;cursor: pointer;font-size: 1.5rem;padding: .5rem;border-radius: 1rem;transition: all 0.3s ease; " id="reload"><i class="fa-solid fa-rotate"></i></span><div class="form-group">';
  modal_content += '<textarea name="chat_message_'+to_seller_id+'" id="chat_message_'+to_seller_id+'" class="form-control"></textarea>';
  modal_content += '</div><div class="form-group" align="right">';
  modal_content+= '<button type="button" name="send_chat" id="'+to_seller_id+'" class="btn btn-info send_chat">Send</button></div></div>';
  $('#user_model_details').html(modal_content);
 }

 $(document).on('click', '.start_chat', function(){
  var to_seller_id = $(this).data('tosellerid');
  var to_user_name = $(this).data('tousername');
  make_chat_dialog_box(to_seller_id, to_user_name);
 
  $("#user_dialog_"+to_seller_id).dialog({
   autoOpen:false,
   width:400,
   height:460
  });
  $(document).on('click', '#reload', function(){
   seller_load_message();
  });
  $('#user_dialog_'+to_seller_id).dialog('open');
  seller_load_message();
  function seller_load_message(){
  $.ajax({
   url:"fetch_seller_chat.php",
   method:"get",
   data:{user_id:<?php echo $user_id ?>, seller_id:to_seller_id},
   
   success:function(data)
   { 
      if(data['seller']=='')
      {
    $('#chat_message_'+to_seller_id).val('');
    $('#chat_history_'+to_seller_id).html(data);
      }
      else{
         $('#chat_message_'+to_seller_id).val('');
         $('#chat_history_'+to_seller_id).html(data);
         
      }
   }
  
  })
}
 });

 
 $(document).on('click', '.send_chat', function(){
    var to_seller_id =  $(this).attr('id');;
  var chat_message = $('#chat_message_'+to_seller_id).val();
  console.log(chat_message);
  $.ajax({
   url:"send_message.php",
   method:"get",
   data:{seller_id:to_seller_id, text:chat_message},
   success:function(data)
   {
    $('#chat_message_'+to_seller_id).val('');
      $('#chat_history_'+to_seller_id).append(`<li style="display: flex;justify-content: flex-end;" class="list-unstyled">
   <p style=" color: #fff;
   width: fit-content;
   margin-left: 16rem;
   background: black;
   border-radius: 10px;
   padding: 8px 10px;
   font-size: 14px;
   word-break:normal;"class="seller">`+chat_message+`</p>
  </li>`);
   }
   
  })
 });


});  
</script>
