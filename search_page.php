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
   <title>search page</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="search-form">
   <form action="" method="post">
      <input type="text" id="search_box" autocomplete="off" placeholder="Please type 3 letters..." maxlength="100" class="box" required>
   </form>
</section>



<section class="products" style="padding-top: 0; min-height:100vh;">
<div class="box-container">
               <div id='search_list'></div>
               </div>
              
</section>




<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script >
        $(document).ready(function() {
            $("#search_box").keyup(function() {
                var search_query = $(this).val();
                
                if (search_query != "") {
                    $.ajax({
                        url: "search_data.php",
                        method: "POST",
                        data: {
                           search_query : search_query
                           
                        },
                        
                        success: function(data) {
                            $("#search_list").fadeIn('fast').html(data);
                        }
                    });
                } else {
                    $("#search_list").fadeOut();
                    
                }
            });
        });
    </script>









<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>