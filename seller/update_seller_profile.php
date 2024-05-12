<?php

include '../components/connect.php';

session_start();

$seller_id = $_SESSION['seller_id'];

if(!isset($seller_id)){
   header('location:seller_login.php');
}

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
 
 
   $update_seller = $conn->prepare("UPDATE `seller` SET name = ?, username = ?, description = ?,email=?,phone=?,f_language=?,s_language=? WHERE id = ?");
   $update_seller->execute([$name, $username,$description,$email,$phone,$f_language,$s_language,$seller_id]);
   $message[] = 'Update Successful';
   $message_status[]='success';

 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/seller_style.css">

</head>
<body>

<?php include '../components/seller_header.php'; ?>
<section class='update'>
<div class="container-reg">
    <div class="titlee">Update</div>
    <div class="content-reg">
    <?php
      $select_seller = $conn->prepare("SELECT * FROM `seller` WHERE id = ?");
      $select_seller->execute([$seller_id]);
      if($select_seller->rowCount() > 0){
         while($fetch_seller = $select_seller->fetch(PDO::FETCH_ASSOC)){ 
   ?>
      <form action=""  method="post">
        <div class="user-details-reg">
          <div class="input-box">
            <span class="details-reg">Full Name</span>
            <input type="text" placeholder="Enter your name" name="name" value="<?= $fetch_seller['name']; ?>" required>
          </div>
          <div class="input-box">
            <span class="details-reg">Username</span>
            <input type="text" placeholder="Enter your username" name="username" value="<?= $fetch_seller['username']; ?>" required>
          </div>
          <div class="input-box">
            <span class="details-reg">Email</span>
            <input type="email" placeholder="Enter your email" name="email" value="<?= $fetch_seller['email']; ?>"required>
          </div>
          <div class="input-box">
            <span class="details-reg">Phone Number</span>
            <input type="text" placeholder="Enter your number" name="phone" value="<?= $fetch_seller['phone']; ?>" required>
          </div>
          <div class="input-box">
            <span class="details-reg">Description</span>
            <textarea name="description"  id="textarea" rows="8" cols="85"><?php echo $fetch_seller['description']; ?></textarea> 
          </div>    
        </div>  
       
        <div class="input-box">
          <span class="details-reg">Primary Language</span>
          <select name="f_language" data-placeholder="Choose a Language...">
          <option value="" disabled selected>Select your Language</option>
          <option value="Afrikaans"<?=$fetch_seller['f_language'] == 'Afrikaans' ? ' selected="selected"' : '';?>>Afrikaans</option>
                  <option value="Albanian"<?=$fetch_seller['f_language'] == 'Albanian' ? ' selected="selected"' : '';?>>Albanian</option>
                  <option value="Arabic"<?=$fetch_seller['f_language'] == 'Arabic' ? ' selected="selected"' : '';?>>Arabic</option>
                  <option value="Armenian"<?=$fetch_seller['f_language'] == 'Armenian' ? ' selected="selected"' : '';?>>Armenian</option>
                  <option value="Basque"<?=$fetch_seller['f_language'] == 'Basque' ? ' selected="selected"' : '';?>>Basque</option>
                  <option value="Bengali"<?=$fetch_seller['f_language'] == 'Bengali' ? ' selected="selected"' : '';?>>Bengali</option>
                  <option value="Bulgarian"<?=$fetch_seller['f_language'] == 'Bulgarian' ? ' selected="selected"' : '';?>>Bulgarian</option>
                  <option value="Catalan"<?=$fetch_seller['f_language'] == 'Catalan' ? ' selected="selected"' : '';?>>Catalan</option>
                  <option value="Cambodian"<?=$fetch_seller['f_language'] == 'Cambodian' ? ' selected="selected"' : '';?>>Cambodian</option>
                  <option value="Chinese (Mandarin)"<?=$fetch_seller['f_language'] == 'Chinese (Mandarian)' ? ' selected="selected"' : '';?>>Chinese (Mandarin)</option>
                  <option value="Croatian"<?=$fetch_seller['f_language'] == 'Croatian' ? ' selected="selected"' : '';?>>Croatian</option>
                  <option value="Czech"<?=$fetch_seller['f_language'] == 'Czech' ? ' selected="selected"' : '';?>>Czech</option>
                  <option value="Danish"<?=$fetch_seller['f_language'] == 'Danish' ? ' selected="selected"' : '';?>>Danish</option>
                  <option value="Dutch"<?=$fetch_seller['f_language'] == 'Dutch' ? ' selected="selected"' : '';?>>Dutch</option>
                  <option value="English"<?=$fetch_seller['f_language'] == 'English' ? ' selected="selected"' : '';?>>English</option>
                  <option value="Estonian"<?=$fetch_seller['f_language'] == 'Estonian' ? ' selected="selected"' : '';?>>Estonian</option>
                  <option value="Fiji"<?=$fetch_seller['f_language'] == 'Fiji' ? ' selected="selected"' : '';?>>Fiji</option>
                  <option value="Finnish"<?=$fetch_seller['f_language'] == 'Finnish' ? ' selected="selected"' : '';?>>Finnish</option>
                  <option value="French"<?=$fetch_seller['f_language'] == 'French' ? ' selected="selected"' : '';?>>French</option>
                  <option value="Georgian"<?=$fetch_seller['f_language'] == 'Georgian' ? ' selected="selected"' : '';?>>Georgian</option>
                  <option value="German"<?=$fetch_seller['f_language'] == 'German' ? ' selected="selected"' : '';?>>German</option>
                  <option value="Greek"<?=$fetch_seller['f_language'] == 'Greek' ? ' selected="selected"' : '';?>>Greek</option>
                  <option value="Gujarati"<?=$fetch_seller['f_language'] == 'Gujarati' ? ' selected="selected"' : '';?>>Gujarati</option>
                  <option value="Hebrew"<?=$fetch_seller['f_language'] == 'Hebrew' ? ' selected="selected"' : '';?>>Hebrew</option>
                  <option value="Hindi"<?=$fetch_seller['f_language'] == 'Hindi' ? ' selected="selected"' : '';?>>Hindi</option>
                  <option value="Hungarian"<?=$fetch_seller['f_language'] == 'Hungarian' ? ' selected="selected"' : '';?>>Hungarian</option>
                  <option value="Icelandic"<?=$fetch_seller['f_language'] == 'Icelandic' ? ' selected="selected"' : '';?>>Icelandic</option>
                  <option value="Indonesian"<?=$fetch_seller['f_language'] == 'Indonesian' ? ' selected="selected"' : '';?>>Indonesian</option>
                  <option value="Irish"<?=$fetch_seller['f_language'] == 'Irish' ? ' selected="selected"' : '';?>>Irish</option>
                  <option value="Italian"<?=$fetch_seller['f_language'] == 'Italian' ? ' selected="selected"' : '';?>>Italian</option>
                  <option value="Japanese"<?=$fetch_seller['f_language'] == 'Japanese' ? ' selected="selected"' : '';?>>Japanese</option>
                  <option value="Javanese"<?=$fetch_seller['f_language'] == 'Javanese' ? ' selected="selected"' : '';?>>Javanese</option>
                  <option value="Korean"<?=$fetch_seller['f_language'] == 'Korean' ? ' selected="selected"' : '';?>>Korean</option>
                  <option value="Latin"<?=$fetch_seller['f_language'] == 'Latin' ? ' selected="selected"' : '';?>>Latin</option>
                  <option value="Latvian"<?=$fetch_seller['f_language'] == 'Latvian' ? ' selected="selected"' : '';?>>Latvian</option>
                  <option value="Lithuanian"<?=$fetch_seller['f_language'] == 'Lithuanian' ? ' selected="selected"' : '';?>>Lithuanian</option>
                  <option value="Macedonian"<?=$fetch_seller['f_language'] == 'Macedonian' ? ' selected="selected"' : '';?>>Macedonian</option>
                  <option value="Malay"<?=$fetch_seller['f_language'] == 'Malay' ? ' selected="selected"' : '';?>>Malay</option>
                  <option value="Malayalam"<?=$fetch_seller['f_language'] == 'Malayalam' ? ' selected="selected"' : '';?>>Malayalam</option>
                  <option value="Maltese"<?=$fetch_seller['f_language'] == 'Maltese' ? ' selected="selected"' : '';?>>Maltese</option>
                  <option value="Maori"<?=$fetch_seller['f_language'] == 'Maori' ? ' selected="selected"' : '';?>>Maori</option>
                  <option value="Marathi"<?=$fetch_seller['f_language'] == 'Marathi' ? ' selected="selected"' : '';?>>Marathi</option>
                  <option value="Mongolian"<?=$fetch_seller['f_language'] == 'Mongolian' ? ' selected="selected"' : '';?>>Mongolian</option>
                  <option value="Nepali"<?=$fetch_seller['f_language'] == 'Nepali' ? ' selected="selected"' : '';?>>Nepali</option>
                  <option value="Norwegian"<?=$fetch_seller['f_language'] == 'Norwegian' ? ' selected="selected"' : '';?>>Norwegian</option>
                  <option value="Persian"<?=$fetch_seller['f_language'] == 'Persian' ? ' selected="selected"' : '';?>>Persian</option>
                  <option value="Polish"<?=$fetch_seller['f_language'] == 'Polish' ? ' selected="selected"' : '';?>>Polish</option>
                  <option value="Portuguese"<?=$fetch_seller['f_language'] == 'Portuguese' ? ' selected="selected"' : '';?>>Portuguese</option>
                  <option value="Punjabi"<?=$fetch_seller['f_language'] == 'Punjabi' ? ' selected="selected"' : '';?>>Punjabi</option>
                  <option value="Quechua"<?=$fetch_seller['f_language'] == 'Quechua' ? ' selected="selected"' : '';?>>Quechua</option>
                  <option value="Romanian"<?=$fetch_seller['f_language'] == 'Romanian' ? ' selected="selected"' : '';?>>Romanian</option>
                  <option value="Russian"<?=$fetch_seller['f_language'] == 'Russian' ? ' selected="selected"' : '';?>>Russian</option>
                  <option value="Samoan"<?=$fetch_seller['f_language'] == 'Samoan' ? ' selected="selected"' : '';?>>Samoan</option>
                  <option value="Serbian"<?=$fetch_seller['f_language'] == 'Serbian' ? ' selected="selected"' : '';?>>Serbian</option>
                  <option value="Slovak"<?=$fetch_seller['f_language'] == 'Slovak' ? ' selected="selected"' : '';?>>Slovak</option>
                  <option value="Slovenian"<?=$fetch_seller['f_language'] == 'Slovenian' ? ' selected="selected"' : '';?>>Slovenian</option>
                  <option value="Spanish"<?=$fetch_seller['f_language'] == 'Spanish' ? ' selected="selected"' : '';?>>Spanish</option>
                  <option value="Swahili"<?=$fetch_seller['f_language'] == 'Swahili' ? ' selected="selected"' : '';?>>Swahili</option>
                  <option value="Swedish"<?=$fetch_seller['f_language'] == 'Swedish' ? ' selected="selected"' : '';?>>Swedish</option>
                  <option value="Tamil"<?=$fetch_seller['f_language'] == 'Tamil' ? ' selected="selected"' : '';?>>Tamil</option>
                  <option value="Tatar"<?=$fetch_seller['f_language'] == 'Tatar' ? ' selected="selected"' : '';?>>Tatar</option>
                  <option value="Telugu"<?=$fetch_seller['f_language'] == 'Telugu' ? ' selected="selected"' : '';?>>Telugu</option>
                  <option value="Thai"<?=$fetch_seller['f_language'] == 'Thai' ? ' selected="selected"' : '';?>>Thai</option>
                  <option value="Tibetan"<?=$fetch_seller['f_language'] == 'Tibetan' ? ' selected="selected"' : '';?>>Tibetan</option>
                  <option value="Tonga"<?=$fetch_seller['f_language'] == 'Tonga' ? ' selected="selected"' : '';?>>Tonga</option>
                  <option value="Turkish"<?=$fetch_seller['f_language'] == 'Turkish' ? ' selected="selected"' : '';?>>Turkish</option>
                  <option value="Ukrainian"<?=$fetch_seller['f_language'] == 'Ukrainian' ? ' selected="selected"' : '';?>>Ukrainian</option>
                  <option value="Urdu"<?=$fetch_seller['f_language'] == 'Urdu' ? ' selected="selected"' : '';?>>Urdu</option>
                  <option value="Uzbek"<?=$fetch_seller['f_language'] == 'Uzbek' ? ' selected="selected"' : '';?>>Uzbek</option>
                  <option value="Vietnamese"<?=$fetch_seller['f_language'] == 'Vietnamese' ? ' selected="selected"' : '';?>>Vietnamese</option>
                  <option value="Welsh"<?=$fetch_seller['f_language'] == 'Welsh' ? ' selected="selected"' : '';?>>Welsh</option>
                  <option value="Xhosa"<?=$fetch_seller['f_language'] == 'Xhosa' ? ' selected="selected"' : '';?>>Xhosa</option>
              </select> 
              
          </div>

          <div class="input-box">
          <span class="details-reg">Secondary Language</span>
          <select name="s_language" data-placeholder="Choose a Language...">
          <option value="" disabled selected>Select your Language</option>
          <option value="Afrikaans"<?=$fetch_seller['s_language'] == 'Afrikaans' ? ' selected="selected"' : '';?>>Afrikaans</option>
                  <option value="Albanian"<?=$fetch_seller['s_language'] == 'Albanian' ? ' selected="selected"' : '';?>>Albanian</option>
                  <option value="Arabic"<?=$fetch_seller['s_language'] == 'Arabic' ? ' selected="selected"' : '';?>>Arabic</option>
                  <option value="Armenian"<?=$fetch_seller['s_language'] == 'Armenian' ? ' selected="selected"' : '';?>>Armenian</option>
                  <option value="Basque"<?=$fetch_seller['s_language'] == 'Basque' ? ' selected="selected"' : '';?>>Basque</option>
                  <option value="Bengali"<?=$fetch_seller['s_language'] == 'Bengali' ? ' selected="selected"' : '';?>>Bengali</option>
                  <option value="Bulgarian"<?=$fetch_seller['s_language'] == 'Bulgarian' ? ' selected="selected"' : '';?>>Bulgarian</option>
                  <option value="Catalan"<?=$fetch_seller['s_language'] == 'Catalan' ? ' selected="selected"' : '';?>>Catalan</option>
                  <option value="Cambodian"<?=$fetch_seller['s_language'] == 'Cambodian' ? ' selected="selected"' : '';?>>Cambodian</option>
                  <option value="Chinese (Mandarin)"<?=$fetch_seller['s_language'] == 'Chinese (Mandarian)' ? ' selected="selected"' : '';?>>Chinese (Mandarin)</option>
                  <option value="Croatian"<?=$fetch_seller['s_language'] == 'Croatian' ? ' selected="selected"' : '';?>>Croatian</option>
                  <option value="Czech"<?=$fetch_seller['s_language'] == 'Czech' ? ' selected="selected"' : '';?>>Czech</option>
                  <option value="Danish"<?=$fetch_seller['s_language'] == 'Danish' ? ' selected="selected"' : '';?>>Danish</option>
                  <option value="Dutch"<?=$fetch_seller['s_language'] == 'Dutch' ? ' selected="selected"' : '';?>>Dutch</option>
                  <option value="English"<?=$fetch_seller['s_language'] == 'English' ? ' selected="selected"' : '';?>>English</option>
                  <option value="Estonian"<?=$fetch_seller['s_language'] == 'Estonian' ? ' selected="selected"' : '';?>>Estonian</option>
                  <option value="Fiji"<?=$fetch_seller['s_language'] == 'Fiji' ? ' selected="selected"' : '';?>>Fiji</option>
                  <option value="Finnish"<?=$fetch_seller['s_language'] == 'Finnish' ? ' selected="selected"' : '';?>>Finnish</option>
                  <option value="French"<?=$fetch_seller['s_language'] == 'French' ? ' selected="selected"' : '';?>>French</option>
                  <option value="Georgian"<?=$fetch_seller['s_language'] == 'Georgian' ? ' selected="selected"' : '';?>>Georgian</option>
                  <option value="German"<?=$fetch_seller['s_language'] == 'German' ? ' selected="selected"' : '';?>>German</option>
                  <option value="Greek"<?=$fetch_seller['s_language'] == 'Greek' ? ' selected="selected"' : '';?>>Greek</option>
                  <option value="Gujarati"<?=$fetch_seller['s_language'] == 'Gujarati' ? ' selected="selected"' : '';?>>Gujarati</option>
                  <option value="Hebrew"<?=$fetch_seller['s_language'] == 'Hebrew' ? ' selected="selected"' : '';?>>Hebrew</option>
                  <option value="Hindi"<?=$fetch_seller['s_language'] == 'Hindi' ? ' selected="selected"' : '';?>>Hindi</option>
                  <option value="Hungarian"<?=$fetch_seller['s_language'] == 'Hungarian' ? ' selected="selected"' : '';?>>Hungarian</option>
                  <option value="Icelandic"<?=$fetch_seller['s_language'] == 'Icelandic' ? ' selected="selected"' : '';?>>Icelandic</option>
                  <option value="Indonesian"<?=$fetch_seller['s_language'] == 'Indonesian' ? ' selected="selected"' : '';?>>Indonesian</option>
                  <option value="Irish"<?=$fetch_seller['s_language'] == 'Irish' ? ' selected="selected"' : '';?>>Irish</option>
                  <option value="Italian"<?=$fetch_seller['s_language'] == 'Italian' ? ' selected="selected"' : '';?>>Italian</option>
                  <option value="Japanese"<?=$fetch_seller['s_language'] == 'Japanese' ? ' selected="selected"' : '';?>>Japanese</option>
                  <option value="Javanese"<?=$fetch_seller['s_language'] == 'Javanese' ? ' selected="selected"' : '';?>>Javanese</option>
                  <option value="Korean"<?=$fetch_seller['s_language'] == 'Korean' ? ' selected="selected"' : '';?>>Korean</option>
                  <option value="Latin"<?=$fetch_seller['s_language'] == 'Latin' ? ' selected="selected"' : '';?>>Latin</option>
                  <option value="Latvian"<?=$fetch_seller['s_language'] == 'Latvian' ? ' selected="selected"' : '';?>>Latvian</option>
                  <option value="Lithuanian"<?=$fetch_seller['s_language'] == 'Lithuanian' ? ' selected="selected"' : '';?>>Lithuanian</option>
                  <option value="Macedonian"<?=$fetch_seller['s_language'] == 'Macedonian' ? ' selected="selected"' : '';?>>Macedonian</option>
                  <option value="Malay"<?=$fetch_seller['s_language'] == 'Malay' ? ' selected="selected"' : '';?>>Malay</option>
                  <option value="Malayalam"<?=$fetch_seller['s_language'] == 'Malayalam' ? ' selected="selected"' : '';?>>Malayalam</option>
                  <option value="Maltese"<?=$fetch_seller['s_language'] == 'Maltese' ? ' selected="selected"' : '';?>>Maltese</option>
                  <option value="Maori"<?=$fetch_seller['s_language'] == 'Maori' ? ' selected="selected"' : '';?>>Maori</option>
                  <option value="Marathi"<?=$fetch_seller['s_language'] == 'Marathi' ? ' selected="selected"' : '';?>>Marathi</option>
                  <option value="Mongolian"<?=$fetch_seller['s_language'] == 'Mongolian' ? ' selected="selected"' : '';?>>Mongolian</option>
                  <option value="Nepali"<?=$fetch_seller['s_language'] == 'Nepali' ? ' selected="selected"' : '';?>>Nepali</option>
                  <option value="Norwegian"<?=$fetch_seller['s_language'] == 'Norwegian' ? ' selected="selected"' : '';?>>Norwegian</option>
                  <option value="Persian"<?=$fetch_seller['s_language'] == 'Persian' ? ' selected="selected"' : '';?>>Persian</option>
                  <option value="Polish"<?=$fetch_seller['s_language'] == 'Polish' ? ' selected="selected"' : '';?>>Polish</option>
                  <option value="Portuguese"<?=$fetch_seller['s_language'] == 'Portuguese' ? ' selected="selected"' : '';?>>Portuguese</option>
                  <option value="Punjabi"<?=$fetch_seller['s_language'] == 'Punjabi' ? ' selected="selected"' : '';?>>Punjabi</option>
                  <option value="Quechua"<?=$fetch_seller['s_language'] == 'Quechua' ? ' selected="selected"' : '';?>>Quechua</option>
                  <option value="Romanian"<?=$fetch_seller['s_language'] == 'Romanian' ? ' selected="selected"' : '';?>>Romanian</option>
                  <option value="Russian"<?=$fetch_seller['s_language'] == 'Russian' ? ' selected="selected"' : '';?>>Russian</option>
                  <option value="Samoan"<?=$fetch_seller['s_language'] == 'Samoan' ? ' selected="selected"' : '';?>>Samoan</option>
                  <option value="Serbian"<?=$fetch_seller['s_language'] == 'Serbian' ? ' selected="selected"' : '';?>>Serbian</option>
                  <option value="Slovak"<?=$fetch_seller['s_language'] == 'Slovak' ? ' selected="selected"' : '';?>>Slovak</option>
                  <option value="Slovenian"<?=$fetch_seller['s_language'] == 'Slovenian' ? ' selected="selected"' : '';?>>Slovenian</option>
                  <option value="Spanish"<?=$fetch_seller['s_language'] == 'Spanish' ? ' selected="selected"' : '';?>>Spanish</option>
                  <option value="Swahili"<?=$fetch_seller['s_language'] == 'Swahili' ? ' selected="selected"' : '';?>>Swahili</option>
                  <option value="Swedish"<?=$fetch_seller['s_language'] == 'Swedish' ? ' selected="selected"' : '';?>>Swedish</option>
                  <option value="Tamil"<?=$fetch_seller['s_language'] == 'Tamil' ? ' selected="selected"' : '';?>>Tamil</option>
                  <option value="Tatar"<?=$fetch_seller['s_language'] == 'Tatar' ? ' selected="selected"' : '';?>>Tatar</option>
                  <option value="Telugu"<?=$fetch_seller['s_language'] == 'Telugu' ? ' selected="selected"' : '';?>>Telugu</option>
                  <option value="Thai"<?=$fetch_seller['s_language'] == 'Thai' ? ' selected="selected"' : '';?>>Thai</option>
                  <option value="Tibetan"<?=$fetch_seller['s_language'] == 'Tibetan' ? ' selected="selected"' : '';?>>Tibetan</option>
                  <option value="Tonga"<?=$fetch_seller['s_language'] == 'Tonga' ? ' selected="selected"' : '';?>>Tonga</option>
                  <option value="Turkish"<?=$fetch_seller['s_language'] == 'Turkish' ? ' selected="selected"' : '';?>>Turkish</option>
                  <option value="Ukrainian"<?=$fetch_seller['s_language'] == 'Ukrainian' ? ' selected="selected"' : '';?>>Ukrainian</option>
                  <option value="Urdu"<?=$fetch_seller['s_language'] == 'Urdu' ? ' selected="selected"' : '';?>>Urdu</option>
                  <option value="Uzbek"<?=$fetch_seller['s_language'] == 'Uzbek' ? ' selected="selected"' : '';?>>Uzbek</option>
                  <option value="Vietnamese"<?=$fetch_seller['s_language'] == 'Vietnamese' ? ' selected="selected"' : '';?>>Vietnamese</option>
                  <option value="Welsh"<?=$fetch_seller['s_language'] == 'Welsh' ? ' selected="selected"' : '';?>>Welsh</option>
                  <option value="Xhosa"<?=$fetch_seller['s_language'] == 'Xhosa' ? ' selected="selected"' : '';?>>Xhosa</option>
              </select> 
          </div>
        <div class="button-reg">
          <input type="submit" value="update" class="btn"  name="submit">
        </div>
      </form>
    </div>
  </div>
  </section>
  <?php
         }
      }else{
         echo '<p class="empty">no product found!</p>';
      }
   ?>











<script src="../js/seller_script.js"></script>
   
</body>
</html>