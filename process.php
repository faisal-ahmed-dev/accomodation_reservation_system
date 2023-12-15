
<?php
include 'components/connect.php';
if(isset($_POST['submit'])){
    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $name = $_POST["name"];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST["pass"]);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   
    $insert_user = $conn->prepare("INSERT INTO `users`(name, email,password) VALUES(?,?,?)");
    $insert_user->execute([$name, $email,$pass]);

   


}

?>