<?php
@include 'config.php';

if (isset($_POST['submit'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   // Handle file upload
   $targetDir = "uploads/"; // Directory where the file will be stored
   $targetFile = $targetDir . basename($_FILES["image"]["name"]); // Get the file name
   $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION)); // Get the file extension

   // Check if image file is a actual image or fake image
   $check = getimagesize($_FILES["image"]["tmp_name"]);
   if($check !== false) {
      // Allow only certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
         $error[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      } else {
         // Upload the file
         if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // File uploaded successfully
            $imagePath = $targetFile;

            // Check if user already exists
            $select = "SELECT * FROM user_form WHERE email = '$email'";
            $result = mysqli_query($conn, $select);

            if (mysqli_num_rows($result) > 0) {
               $error[] = 'User already exists!';
            } else {
               if ($pass != $cpass) {
                  $error[] = 'Passwords do not match!';
               } else {
                  // Insert user data into the database
                  $insert = "INSERT INTO user_form(name, email, password, image) 
                             VALUES('$name','$email','$pass','$imagePath')";
                  mysqli_query($conn, $insert);
                  header('location: login_form.php');
                  exit;
               }
            }
         } else {
            $error[] = "Sorry, there was an error uploading your file.";
         }
      }
   } else {
      $error[] = "File is not an image.";
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css2\style.css">

</head>

<body id="body">
   <div id="uiuLogo">
      <img src="css/uiu.png" alt="">
   </div>
   <div class=black2>
   <div class="form-container">

      <form action="" method="post" id="form" class="regForm" enctype="multipart/form-data">
         <h3>register now</h3>
         <?php
         if (isset($error)) {
            foreach ($error as $error) {
               echo '<span class="error-msg">' . $error . '</span>';
            };
         };
         ?>
         <input type="text" name="name" required placeholder="enter your name">
         <input type="email" name="email" required placeholder="enter your email">
         <input type="text" name="phone" required placeholder="enter your phone number">
         <input type="password" name="password" required placeholder="enter your password">
         <input type="password" name="cpassword" required placeholder="confirm your password">
         <input type="file" name="image" required accept="image/*">
         <input type="submit" name="submit" value="register now" class="form-btn">
         <p>already have an account? <a href="login_form.php">login now</a></p>
      </form>

   </div>
 </div>  

</body>

</html>