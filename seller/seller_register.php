<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $username = $_POST['username'];
  $username = filter_var($username, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $phone = $_POST['phone'];
  $phone = filter_var($phone, FILTER_SANITIZE_STRING);
  $f_language = $_POST['f_language'];
  $f_language = filter_var($f_language, FILTER_SANITIZE_STRING);
  $s_language = $_POST['s_language'];
  $s_language= filter_var($s_language, FILTER_SANITIZE_STRING);
  $description = $_POST['description'];
  $description= filter_var($description, FILTER_SANITIZE_STRING);
  $pass = sha1($_POST['pass']);
  $pass = filter_var($pass, FILTER_SANITIZE_STRING);
  $cpass = sha1($_POST['cpass']);
  $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);


  $select_user = $conn->prepare("SELECT * FROM `seller` WHERE email = ? or username= ?");
  $select_user->execute([$email,$username]);
  $row = $select_user->fetch(PDO::FETCH_ASSOC);

  if($select_user->rowCount() > 0){
     $message[] = 'email or username already exists!';
     $message_status[]='error';
  }else{
     if($pass != $cpass){
        $message[] = 'confirm password not matched!';
        $message_status[]='error';
     }else{
        $insert_user = $conn->prepare("INSERT INTO `seller`(name,username, email, password,phone,f_language,s_language,description) VALUES(?,?,?,?,?,?,?,?)");
        $insert_user->execute([$name,$username, $email, $pass,$phone,$f_language,$s_language,$description]);
        $message[] = 'registered successfully, login now please!';
        $message_status[]='success';
       

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
   <title>Register</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/seller_style.css">

</head>
<body class="reg">

<script src="sweetalert2.min.js"></script>
<script src="sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="@sweetalert2/themes/dark/dark.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
  if(isset($message) && $message!='' && isset($message_status) && $message_status!=''){
   foreach(array_combine($message, $message_status) as $code => $name){
      ?>
      <script>
            
                        Swal.fire({
icon: "<?php echo $name;?>", 
html: "<?php echo $code ;?>",  
showCloseButton: true,
background: 'white'
} );
      </script>
 <?php  }
   }
   ?>

  <div class="container-reg">
    <div class="titlee">Registration</div>
    <div class="content-reg">
      <form action=""  method="post">
        <div class="user-details-reg">
          <div class="input-box">
            <span class="details-reg">Full Name</span>
            <input type="text" placeholder="Enter your name" name="name" required>
          </div>
          <div class="input-box">
            <span class="details-reg">Username</span>
            <input type="text" placeholder="Enter your username" name="username" required>
          </div>
          <div class="input-box">
            <span class="details-reg">Email</span>
            <input type="email" placeholder="Enter your email" name="email" required>
          </div>
          <div class="input-box">
            <span class="details-reg">Phone Number</span>
            <input type="text" placeholder="Enter your number" name="phone" required>
          </div>
          <div class="input-box">
            <span class="details-reg">Password</span>
            <input type="password" placeholder="Enter your password" name="pass" required>
          </div>
          <div class="input-box">
            <span class="details-reg">Confirm Password</span>
            <input type="password" placeholder="Confirm your password" name="cpass" required>
          </div>
          <div class="input-box">
          <span class="details-reg">Language</span>
          <select name="f_language" data-placeholder="Choose a Language...">
          <option value="" disabled selected>Select your Language</option>
          <option value="Afrikaans">Afrikaans</option>
                  <option value="Albanian">Albanian</option>
                  <option value="Arabic">Arabic</option>
                  <option value="Armenian">Armenian</option>
                  <option value="Basque">Basque</option>
                  <option value="Bengali">Bengali</option>
                  <option value="Bulgarian">Bulgarian</option>
                  <option value="Catalan">Catalan</option>
                  <option value="Cambodian">Cambodian</option>
                  <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
                  <option value="Croatian">Croatian</option>
                  <option value="Czech">Czech</option>
                  <option value="Danish">Danish</option>
                  <option value="Dutch">Dutch</option>
                  <option value="English">English</option>
                  <option value="Estonian">Estonian</option>
                  <option value="Fiji">Fiji</option>
                  <option value="Finnish">Finnish</option>
                  <option value="French">French</option>
                  <option value="Georgian">Georgian</option>
                  <option value="German">German</option>
                  <option value="Greek">Greek</option>
                  <option value="Gujarati">Gujarati</option>
                  <option value="Hebrew">Hebrew</option>
                  <option value="Hindi">Hindi</option>
                  <option value="Hungarian">Hungarian</option>
                  <option value="Icelandic">Icelandic</option>
                  <option value="Indonesian">Indonesian</option>
                  <option value="Irish">Irish</option>
                  <option value="Italian">Italian</option>
                  <option value="Japanese">Japanese</option>
                  <option value="Javanese">Javanese</option>
                  <option value="Korean">Korean</option>
                  <option value="Latin">Latin</option>
                  <option value="Latvian">Latvian</option>
                  <option value="Lithuanian">Lithuanian</option>
                  <option value="Macedonian">Macedonian</option>
                  <option value="Malay">Malay</option>
                  <option value="Malayalam">Malayalam</option>
                  <option value="Maltese">Maltese</option>
                  <option value="Maori">Maori</option>
                  <option value="Marathi">Marathi</option>
                  <option value="Mongolian">Mongolian</option>
                  <option value="Nepali">Nepali</option>
                  <option value="Norwegian">Norwegian</option>
                  <option value="Persian">Persian</option>
                  <option value="Polish">Polish</option>
                  <option value="Portuguese">Portuguese</option>
                  <option value="Punjabi">Punjabi</option>
                  <option value="Quechua">Quechua</option>
                  <option value="Romanian">Romanian</option>
                  <option value="Russian">Russian</option>
                  <option value="Samoan">Samoan</option>
                  <option value="Serbian">Serbian</option>
                  <option value="Slovak">Slovak</option>
                  <option value="Slovenian">Slovenian</option>
                  <option value="Spanish">Spanish</option>
                  <option value="Swahili">Swahili</option>
                  <option value="Swedish">Swedish</option>
                  <option value="Tamil">Tamil</option>
                  <option value="Tatar">Tatar</option>
                  <option value="Telugu">Telugu</option>
                  <option value="Thai">Thai</option>
                  <option value="Tibetan">Tibetan</option>
                  <option value="Tonga">Tonga</option>
                  <option value="Turkish">Turkish</option>
                  <option value="Ukrainian">Ukrainian</option>
                  <option value="Urdu">Urdu</option>
                  <option value="Uzbek">Uzbek</option>
                  <option value="Vietnamese">Vietnamese</option>
                  <option value="Welsh">Welsh</option>
                  <option value="Xhosa">Xhosa</option>
              </select> 
          </div>
          <div class="input-box">
          <span class="details-reg">Second Language</span>
          <select name="s_language" data-placeholder="Choose a Language...">
          <option value="" disabled selected>Select your Language</option>
          <option value="Afrikaans">Afrikaans</option>
                  <option value="Albanian">Albanian</option>
                  <option value="Arabic">Arabic</option>
                  <option value="Armenian">Armenian</option>
                  <option value="Basque">Basque</option>
                  <option value="Bengali">Bengali</option>
                  <option value="Bulgarian">Bulgarian</option>
                  <option value="Catalan">Catalan</option>
                  <option value="Cambodian">Cambodian</option>
                  <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
                  <option value="Croatian">Croatian</option>
                  <option value="Czech">Czech</option>
                  <option value="Danish">Danish</option>
                  <option value="Dutch">Dutch</option>
                  <option value="English">English</option>
                  <option value="Estonian">Estonian</option>
                  <option value="Fiji">Fiji</option>
                  <option value="Finnish">Finnish</option>
                  <option value="French">French</option>
                  <option value="Georgian">Georgian</option>
                  <option value="German">German</option>
                  <option value="Greek">Greek</option>
                  <option value="Gujarati">Gujarati</option>
                  <option value="Hebrew">Hebrew</option>
                  <option value="Hindi">Hindi</option>
                  <option value="Hungarian">Hungarian</option>
                  <option value="Icelandic">Icelandic</option>
                  <option value="Indonesian">Indonesian</option>
                  <option value="Irish">Irish</option>
                  <option value="Italian">Italian</option>
                  <option value="Japanese">Japanese</option>
                  <option value="Javanese">Javanese</option>
                  <option value="Korean">Korean</option>
                  <option value="Latin">Latin</option>
                  <option value="Latvian">Latvian</option>
                  <option value="Lithuanian">Lithuanian</option>
                  <option value="Macedonian">Macedonian</option>
                  <option value="Malay">Malay</option>
                  <option value="Malayalam">Malayalam</option>
                  <option value="Maltese">Maltese</option>
                  <option value="Maori">Maori</option>
                  <option value="Marathi">Marathi</option>
                  <option value="Mongolian">Mongolian</option>
                  <option value="Nepali">Nepali</option>
                  <option value="Norwegian">Norwegian</option>
                  <option value="Persian">Persian</option>
                  <option value="Polish">Polish</option>
                  <option value="Portuguese">Portuguese</option>
                  <option value="Punjabi">Punjabi</option>
                  <option value="Quechua">Quechua</option>
                  <option value="Romanian">Romanian</option>
                  <option value="Russian">Russian</option>
                  <option value="Samoan">Samoan</option>
                  <option value="Serbian">Serbian</option>
                  <option value="Slovak">Slovak</option>
                  <option value="Slovenian">Slovenian</option>
                  <option value="Spanish">Spanish</option>
                  <option value="Swahili">Swahili</option>
                  <option value="Swedish">Swedish</option>
                  <option value="Tamil">Tamil</option>
                  <option value="Tatar">Tatar</option>
                  <option value="Telugu">Telugu</option>
                  <option value="Thai">Thai</option>
                  <option value="Tibetan">Tibetan</option>
                  <option value="Tonga">Tonga</option>
                  <option value="Turkish">Turkish</option>
                  <option value="Ukrainian">Ukrainian</option>
                  <option value="Urdu">Urdu</option>
                  <option value="Uzbek">Uzbek</option>
                  <option value="Vietnamese">Vietnamese</option>
                  <option value="Welsh">Welsh</option>
                  <option value="Xhosa">Xhosa</option>
              </select> 
          </div>
          <div class="input-box">
            <span class="details-reg">Description</span>
            <textarea name="description" id="textarea" rows="8" cols="85"></textarea> 
          </div>    
        </div>  
        <div class="button-reg">
          <input type="submit" value="Register" class="btn"  name="submit">
        </div>

        <a href="seller_login.php" class="signup btn"><p><b>Login here</b></p></a>
      </form>
    </div>
  </div>

</body>
</html>




