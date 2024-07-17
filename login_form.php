<?php


@include 'config.php';


session_start();


$error = [];


if (isset($_POST['submit'])) {
   
   $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
   
   $pass = isset($_POST['password']) ? md5($_POST['password']) : '';

   
   $stmt = $conn->prepare("SELECT * FROM user_form WHERE email = ? AND password = ?");
   $stmt->bind_param("ss", $email, $pass);
   $stmt->execute();
   $result = $stmt->get_result();

 
   if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
     
      $_SESSION['user_name'] = $row['name'];
      $_SESSION['id'] = $row['id'];
      
      header('Location: main_page2.php');
      exit();
   } else {
      $error[] = 'Incorrect email or password!';
   }

 
   $stmt->close();
}

?>

<<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login form</title>
   <!-- Custom CSS file link  -->
   <link rel="stylesheet" href="css2\style.css">
</head>

<body id="body">
   <div id="uiuLogo">
      <img src="css/uiu.png" alt="">
   </div>
<div class="black">
   <div class="form-container">
      <form action="" method="post" id="form">
         <h3>Login now</h3>
         <?php
         // Display errors if any
         if (!empty($error)) {
            foreach ($error as $err) {
               echo '<span class="error-msg">' . $err . '</span>';
            }
         }
         ?>
         <input type="email" name="email" required placeholder="Enter your email">
         <input type="password" name="password" required placeholder="Enter your password">
         <input type="submit" name="submit" value="Login now" class="form-btn">
         <p>Don't have an account? <a href="register_form.php">Register now</a></p>
      </form>
   </div>
</div> 

</body>

</html>