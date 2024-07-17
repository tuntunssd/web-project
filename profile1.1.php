<?php

@include 'config.php';

session_start();
$username = $_GET['username'];
$userid=$_GET['userid'];
$query = "SELECT image, email FROM user_form WHERE name = '$username'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $imagePath = $row['image'];
            $email = $row['email'];
        } else {
            // Default values if user data is not found
            $imagePath = "image/default-profile.jpg";
            $email = "No email found";
        }

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Homepage</title>
  <link rel="stylesheet" href="profile1.1.css" />
</head>
<body>
  <div class="container">
    <img src="<?php echo $imagePath ?>" class="hero">
    <div class="header">
      <h1 style="color:black;"><?php echo $username ?></h1>
      <h2 style="color:black;">Code is My Life</h2> 
      <p style="color:black;"><?php echo $email ?></p> 
      <button>More</button>
    </div>
    <div class="body">
      <div class="friend_list_container">
        <div class="friend_card">
          <h2>Friend List</h2>
          <div class="friend_list">
            <div class="friend">
              <img src="images2.2/icon5.png" alt="Ninja Hatori" /> 
              <p>Ninja Hatori</p>
            </div>
            <div class="friend">
              <img src="images2.2/icon4.png" alt="Ron Weasley" /> 
              <p>Ron Weasley</p>
            </div>
            <div class="friend">
              <img src="images2.2/icon3.png" alt="Harry Potter" /> 
              <p>Harry Potter</p>
            </div>
            <div class="friend">
              <img src="images2.2/icon2.png" alt="Cedric Diggory" /> 
              <p>Cedric Diggory</p>
            </div>
          </div>
        </div>
        <button>Show More</button>
      </div>
      <div class="post_container">
        <div class="post_list">
        <div class="middle">
          <!-- create_post Start here -->
          <form class="create-post" action="post4.php" method="post" enctype="multipart/form-data">
                    <div class="profile-photo">
                        <img src="<?php echo $imagePath ?>" alt="">
                    </div>
                  
                            <input type="text" name="text" placeholder="What's on your mind,<?php echo $_SESSION['user_name'] ?>?" id="create-post">
                            <input type="hidden" name="user_id" value="<?php echo $userid; ?>">
                            <label for="first"><i class="fa fa-file-image-o" style="font-size:28px;color: rgb(57, 59, 112); padding-right:20px;"></i></label>
                            <input type="file" id="first" style="display:none;visibility:none;" name="image" accept="image/*">
                            <input type="submit" value="post" class="btn btn-primary">
                   
                </form>
                <div class="feeds">
                 
                    <?php
                    $sql = "SELECT * FROM images WHERE user_id = '$userid'";
                    $result1 = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result1) > 0) {
                        
                        // Loop through each row
                        while($row = mysqli_fetch_assoc($result1)) {
                            $pop=$row['user_id'];
                            $img=$row['file_path'];
                            $text=$row['text'];
                            $sl=$row['sl'];
                            $sq="SELECT image, name FROM user_form WHERE id = '$pop'";
                            $result2 = mysqli_query($conn, $sq);
            
                            if (mysqli_num_rows($result2) > 0) {
                                    $row = mysqli_fetch_assoc($result2);
                                    $imagePath = $row['image'];
                                    $name = $row['name'];
                                    

                                } else {
                                    // Default values if user data is not found
                                    
                                }

                                echo  '<div class="feed"> 
                                                <div class="head">
                                                    <div class="user">
                                                        <div class="profile-photo">
                                                            <img src="'.$imagePath.'" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <h3>'.$name.'</h3>
                                                            <small>'.$text.'</small>
                                                        </div>
                                                    </div>
                                                    <span class="edit">
                                                        <i class="uil uil-ellipsis-h"></i>
                                                    </span>
                                                </div>
                                                <div class="photo">
                                                    <img src="'.$img.'" alt="">
                                                </div>
                                                <div class="action-buttons">
                                                    <div class="interaccion-buttons">
                                                        <span>
                                                            <i class="uil uil-heart"></i>
                                                        </span>
                                                        <span>
                                                            <i class="uil uil-comment-dots"></i>
                                                        </span>
                                                        <span>
                                                            
                                                                <i class="uil uil-share-alt"></i>
                                                                
                                                        </span>
                                                    </div>
                                                    <div class="bookmark">
                                                        <span>
                                                        <form action="post2.php" method="post" enctype="multipart/form-data">
                                                                <label class="r" for="firstg"><i class="uil uil-bookmark"></i></label>
                                                                <input id="firstg" type="submit" value="'.$sl.'" name="userid" >
                                                        </form>    
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="liked-by">
                                                    <span>
                                                        <img src="image\profile-10.jpg" alt="">
                                                    </span>
                                                    <span>
                                                        <img src="image\profile-4.jpg" alt="">
                                                    </span>
                                                    <span>
                                                    
                                                        <img src="image\profile-14.jpg" alt="">
                                                        
                                                    </span>
                                                    <p>Liked by <b>Tina Welberg</b> and <b>2,323 others</b></p>
                                                </div>
                                                <div class="caption">
                                                    <p><b>Georgina Cambel</b> Lorem ipsum, dolor sit amet consectetur. <span class="hashtag">#lifestyle</span>
                                                </div>
                                                <div class="comments text-muted">View all 277 comments</div>
                                            </div>';
                        }
                        
                        } else {
                        echo "No results found";
                        }   
                        ?>
                    </div>
                </div> 
            </div>    
    </div>
  </div>
</body>
</html>
