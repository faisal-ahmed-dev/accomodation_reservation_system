<?php

include 'components/connect.php';

session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
 }else{
    $user_id = '';
 };

   $verify_code = $_SESSION['verify_code'];
   $name = $_SESSION['name'];
   $email = $_SESSION['email'];
   $pass = $_SESSION['pass'];
   $cpass = $_SESSION['cpass'];



if(isset($_POST['submit_verify'])){

    $email_code=$_POST['1st'].$_POST['2nd'].$_POST['3rd'].$_POST['4th'];
    if($verify_code==$email_code)
    {
        
        $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
          $insert_user->execute([$name, $email, $cpass]);
          
            header('location:user_reg_success.php');
       
    }
    else{
        $message[] = 'Code Not matched';
            $message_status[]='error';
    }
    }
    
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Verify</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container verify">

   <form action="" method="post" class="form" id="form">
   <p class="heading">Verify</p>
        <svg class="check" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" xml:space="preserve">  <image id="image0" width="60" height="60" x="0" y="0" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAQAAACQ9RH5AAAABGdBTUEAALGPC/xhBQAAACBjSFJN
        AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
        cwAACxMAAAsTAQCanBgAAAAHdElNRQfnAg0NDzN/r+StAAACR0lEQVRYw+3Yy2sTURTH8W+bNgVf
        aGhFaxNiAoJou3FVEUQE1yL031BEROjCnf4PLlxILZSGYncuiiC48AEKxghaNGiliAojiBWZNnNd
        xDza3pl77jyCyPzO8ubcT85wmUkG0qT539In+MwgoxQoUqDAKDn2kSNLlp3AGi4uDt9xWOUTK3xg
        hVU2wsIZSkxwnHHGKZOxHKfBe6rUqFGlTkPaVmKGn6iYao1ZyhK2zJfY0FZ9ldBzsbMKxZwZjn/e
        5szGw6UsD5I0W6T+hBhjUjiF7bNInjz37Ruj3igGABjbtpIo3GIh30u4ww5wr3fwfJvNcFeznhBs
        YgXw70TYX2bY/ulkZhWfzfBbTdtrzjPFsvFI+T/L35jhp5q2owDs51VIVvHYDM9sa/LY8XdtKy1l
        FXfM8FVN2/X2ajctZxVXzPA5TZvHpfb6CFXxkerUWTOcY11LX9w0tc20inX2mmF4qG3upnNWrOKB
        hIXLPu3dF1x+kRWq6ysHpkjDl+7eQjatYoOCDIZF3006U0unVSxIWTgTsI3HNP3soSJkFaflMDwL
        3OoHrph9YsPCJJ5466DyOGUHY3Epg2rWloUxnMjsNw7aw3AhMjwVhgW4HYm9FZaFQZ/bp6QeMRQe
        hhHehWKXGY7CAuSpW7MfKUZlAUqWdJ3DcbAAB3guZl9yKC4WYLfmT4muFtgVJwvQx7T2t0mnXK6J
        XlGGyAQvfNkaJ5JBmxnipubJ5HKDbJJsM0eY38QucSx5tJWTVHBwqDDZOzRNmn87fwDoyM4J2hRz
        NgAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAyMy0wMi0xM1QxMzoxNTo1MCswMDowMKC8JaoAAAAldEVY
        dGRhdGU6bW9kaWZ5ADIwMjMtMDItMTNUMTM6MTU6NTArMDA6MDDR4Z0WAAAAKHRFWHRkYXRlOnRp
        bWVzdGFtcAAyMDIzLTAyLTEzVDEzOjE1OjUxKzAwOjAwIIO3fQAAAABJRU5ErkJggg=="></image>
        </svg>

        <!--
        <div class="box" data-group-name="digits">
        <input class="input" id="digit-1" name="digit-1" data-next="digit-2"  type="password" maxlength="1">
        <input class="input" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" type="password" maxlength="1"> 
        <input class="input" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" type="password" maxlength="1">
        <input class="input" id="digit-4" name="digit-4" data-next="digit-2" data-previous="digit-3" type="password" maxlength="1">
        </div>
        <button class="btn1">Submit</button>
        <button class="btn2">Back</button>
        -->
        <div class="box">
        <div id="inputs" class="inputs"> 
          
            <input type="text" class="input" name='1st' maxlength="1" autocomplete="off">
            <input type="text" class="input" name="2nd" maxlength="1" autocomplete="off">
            <input type="text" class="input" name="3rd" maxlength="1" autocomplete="off">
            <input type="text" class="input" name="4th" maxlength="1" autocomplete="off">
            </div>
        
        <button class="btn1" name="submit_verify">Submit</button>
        <button class="btn2" onclick="document.location.href='user_register.php';">back</button>
        </div>
      
   </form>

   <form action="" id='send'>
   <input type="hidden" id="verify_code" name="verify_code" value="<?php echo $_SESSION['verify_code']?>"/>
            <input type="hidden" id="name" name="name" value="<?php echo $_SESSION['name']?>"/>
            <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']?>"/>
   <button  class="send_otp" id="send_otp" type="submit" name="send_otp">send otp</button>
   </form>

</section>






<script>


const inputs = document.getElementById("inputs"); 
  
inputs.addEventListener("input", function (e) { 
    const target = e.target; 
    const val = target.value; 
  
    if (isNaN(val)) { 
        target.value = ""; 
        return; 
    } 
  
    if (val != "") { 
        const next = target.nextElementSibling; 
        if (next) { 
            next.focus(); 
        } 
    } 
}); 
  
inputs.addEventListener("keyup", function (e) { 
    const target = e.target; 
    const key = e.key.toLowerCase(); 
  
    if (key == "backspace" || key == "delete") { 
        target.value = ""; 
        const prev = target.previousElementSibling; 
        if (prev) { 
            prev.focus(); 
        } 
        return; 
    } 
});

   
</script>


<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>

   function sendEmail(to, subject, body)
   {
      
      
      Email.send({
    Host : "smtp.elasticemail.com",
    Username : "tourifyHelp@gmail.com",
    Password : "16BC356424993480F4657D1F1010B10895DC",
    To : to,
    From : "tourifyHelp@gmail.com",
    Subject : subject,
    Body : body
         }).then(  
         message => {
            if(message=='OK')
            {
               
 
            }
            else{
                alert('error');
            }
         }
         );
        
   }
   window.addEventListener('load', function () {
  document.getElementById("send_otp").click();})
 
   
   const form = document.getElementById("send");
   
   form.addEventListener("submit", (e) => {
     
   e.preventDefault();
   const data = new FormData(e.target);
   const code= `${data.get("verify_code")}`;
   const to= `${data.get("email")}`;
   const subject = `Welcome ${data.get("name")} To Tourify`;
   const body = `Your Security Code is `+code;
  
   sendEmail(to, subject, body);
   
   });
       
          
              
            
      

</script>



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