<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


if(isset($_POST['submit']))
{
 
   $name=$_POST['name'];
   $email=$_POST['email'];
   $pass=sha1($_POST['pass']);
   $cpass= sha1($_POST['cpass']);
  
   
   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? or id= ?");
   $select_user->execute([$email,$name]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email or username already exists!';
      $message_status[]='error';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
         $message_status[]='error';
      }else{
         $_SESSION['name']=$_POST['name'];
         $_SESSION['email']=$_POST['email'];
         $_SESSION['pass']=sha1($_POST['pass']);
         $_SESSION['cpass'] = sha1($_POST['cpass']);

         sleep(1);
         header('location:user_verify.php');
      
   }

   }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>


<section class="form-container">

   <form action="" method="post"  id='myform' >
      
      <h3>Registration</h3>
      <input type="hidden" id="verify_code" name="verify_code" value="<?php echo $_SESSION['verify_code']= (rand(1000,9999));?>"/>
      <div class="input_container">
      <label for="password_field" class="input_label">Username</label>
      <input type="text" name="name" class="input_field" required maxlength="50" placeholder="Enter your Username Or Email"  oninput="this.value = this.value.replace(/\s/g, '')"/>
      </div>
      <div class="input_container">
      <label for="password_field" class="input_label">Email</label>
      <input type="text" id="email" name="email" class="input_field" required maxlength="50" placeholder="Enter your Username Or Email"  oninput="this.value = this.value.replace(/\s/g, '')"/>
      </div>
      <div class="input_container">
      <label for="password_field" class="input_label">Password</label>
      <input type="password" name="pass" class="input_field" required maxlength="20" placeholder="Enter your Password"  oninput="this.value = this.value.replace(/\s/g, '')"/>
      </div>
      <div class="input_container" >
      <label for="password_field" class="input_label"  >Confirm Password</label>
      <input type="password" name="cpass" class="input_field" required maxlength="20" placeholder="Enter Confirm your Password"  oninput="this.value = this.value.replace(/\s/g, '')"/>
      </div>
      <input type="submit" name="submit" id="button" value="Register now" class="btn" >
      <p>don't have an account?  <a href="user_login.php">login now</a></p>
      
   </form>

</section>












<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
<script src="js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>
</html>