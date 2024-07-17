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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Website</title>
    <link rel="stylesheet" href="css\main_page3.2.css">
    <link rel="stylesheet" href="css\styleRIGHT.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
            .r:link {
            color: green;
            background-color: transparent;
            text-decoration: none;
            }

            .r:hover {
            color: red;
            background-color:transparent ;
            text-decoration: underline;
            }
            .r:active {
            color: yellow;
            background-color: transparent;
            text-decoration: underline;
            }
    </style>
</head>
<body>
    <nav>
        <div class="container">
            <h2 class="logo">
                UIU Social Media
            </h2>
            <div class="search-bar">
                <i class="uil uil-search"></i>
                <input type="search" placeholder="Search for creators, inspirations and proyects">
            </div>
            <div class="create">
                <label for="create-post" class="btn btn-primary">Create</label>
                <div class="profile-photo">
                    <img src="<?php echo $imagePath ?>" alt="Profile photo">
                </div>
            </div>
        </div>
    </nav>

    <!------------------------------ MAIN ------------------------------->
    <main>
        <div class="container">
            <div class="left">
              <a class="profile" href="profile1.1.php?username=<?php echo urlencode($username); ?>&userid=<?php echo urlencode($userid); ?>">
                    <div class="profile-photo">
                        <img src="<?php echo $imagePath ?>" alt="Profile photo">
                    </div>
                    <div class="handle">
                        <h4 style="color:black"><?php echo $_SESSION['user_name'] ?></h4>
                        <p class="text-muted">
                          <h5 style="color:black"><?php echo $email  ?></h5>
                        </p>
                    </div>
                </a>

    <!------------------------------ SIDEBAR ------------------------------->

            <div class="sidebar">
                <a class="menu-item">
                    <span><i class="uil uil-home"></i></span><h3>Home</h3>
                </a>
                <a class="menu-item" href="main_Newsbox.php?username=<?php echo urlencode($username); ?>&userid=<?php echo urlencode($userid); ?>">
                    <span><i class="uil uil-compass"></i></span>
                    <h3 style="color:black">News box</h3>
                </a>
                <a class="menu-item" id="notifications">
                    <span><i class="uil uil-bell"><small class="notification-count">9+</small></i></span><h3>Notifications</h3>
                    <div class="notifications-popup">
                        <div>
                            <div class="profile-photo">
                                <img src="image\profile-2.jpg" alt="">
                            </div>
                            <div class="notification-body">
                                <b>Andy Tomphson</b> accepted your friend request
                                <small class="text-muted">1 HOUR AGO</small>
                            </div>
                        </div>
                        <div>
                            <div class="profile-photo">
                                <img src="image\profile-3.jpg" alt="">
                            </div>
                            <div class="notification-body">
                                <b>Brittany Cole</b> commented your post
                                <small class="text-muted">2 HOURS AGO</small>
                            </div>
                        </div>
                        <div>
                            <div class="profile-photo">
                                <img src="image\profile-4.jpg" alt="">
                            </div>
                            <div class="notification-body">
                                <b>Sofia Verratti</b> commented a post you are tagged
                                <small class="text-muted">4 HOURS AGO</small>
                            </div>
                        </div>
                        <div>
                            <div class="profile-photo">
                                <img src="image\profile-5.jpg" alt="">
                            </div>
                            <div class="notification-body">
                                <b>Claire Johnson</b> accepted your friend request
                                <small class="text-muted">18 HOURS AGO</small>
                            </div>
                        </div>
                        <div>
                            <div class="profile-photo">
                                <img src="image\profile-6.jpg" alt="">
                            </div>
                            <div class="notification-body">
                                <b>Ivana Diatlov</b> liked your comment
                                <small class="text-muted">1 DAY AGO</small>
                            </div>
                        </div>
                        <div>
                            <div class="profile-photo">
                                <img src="image\profile-7.jpg" alt="">
                            </div>
                            <div class="notification-body">
                                <b>Jhonatan Torres</b> liked your post
                                <small class="text-muted">1 DAY AGO</small>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="menu-item" href="massanger.php">
                    <span><i class="uil uil-envelope-alt"></i></span>
                    <h3 style="color:black">Messages</h3>
                </a>
                <a class="menu-item active" >
                        <span><i class="uil uil-bookmark"></i></span>
                        <h3>Save</h3>
                </a>
                <a class="menu-item" href="main_study.php?username=<?php echo urlencode($username); ?>&userid=<?php echo urlencode($userid); ?>">    
                    <span><i class="uil uil-chart-line"></i></span>
                    <h3 style="color:black">Video study Material</h3>
                </a>
                <a class="menu-item" id="theme">
                    <span><i class="uil uil-palette"></i></span>
                    <h3>Theme</h3>
                </a>
                <a class="menu-item">
                    <span><i class="uil uil-setting"></i></span>
                    <h3>Settings</h3>
                </a>
            </div>

            <label for="create post" class="btn btn-primary">Create Post</label>

        </div>

    <!------------------------------ MIDDLE ------------------------------->

            <div class="middle">
                <div class="stories">
                <a href="https://www.uiu.ac.bd/" class="story"></a>
                        <a href="https://ucam.uiu.ac.bd/Security/LogIn.aspx" class="story"></a>
                        <a href="https://lms.uiu.ac.bd/" class="story"></a>
                        <a href="https://cse.uiu.ac.bd/" class="story"></a>
                </div>
                <form class="create-post" action="post.php" method="post" enctype="multipart/form-data">
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
                    $sql = "SELECT * FROM saves";
                    $resultr = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($resultr) > 0) {
                        
                        // Loop through each row
                        while($row = mysqli_fetch_assoc($resultr)) {
                            $pop2=$row['userid'];
                            $sql = "SELECT * FROM images WHERE sl = '$pop2'";
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
                         }
                    }       
                        ?>
                    </div>
                </div>  
                 
                  
                    <!---------------------------------h------------------------------>


    <!------------------------------ RIGHT ------------------------------->

                    <div class="right">
                        <div class="calendar">
                        <div class="month">
                            <i class="fas fa-angle-left prev"></i>
                            <div class="date">December 2015</div>
                            <i class="fas fa-angle-right next"></i>
                        </div>
                        
                        <div class="weekdays">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div class="days"></div>
                        <div class="goto-today">
                            <div class="goto">
                            <input type="text" placeholder="mm/yyyy" class="date-input">
                            <button class="goto-btn">Go</button>
                            </div>
                            <button class="today-btn">Today</button>
                            
                        </div>
                        </div>
                        
                        <div class="event-info">
                        <div class="today-date">
                            <div class="event-day">Wed</div>
                            <div class="event-date">12th December 2022</div>
                        </div>
                        <div class="events">
                            <!-- Event list goes here -->
                        </div>
                        <div class="add-event-wrapper">
                            <div class="add-event-header">
                            <div class="title">Add Event</div>
                            <i class="fas fa-times close"></i>
                            </div>
                            <div class="add-event-body">
                            <div class="add-event-input">
                                <input type="text" placeholder="Event Name" class="event-name">
                            </div>
                            <div class="add-event-input">
                                <input type="text" placeholder="Event Time From" class="event-time-from">
                            </div>
                            <div class="add-event-input">
                                <input type="text" placeholder="Event Time To" class="event-time-to">
                            </div>
                            </div>
                            <div class="add-event-header">
                            <div class="title">Add Event</div>
                            <div class="event-header-text"></div> <!-- Header to display the event text -->
                            <i class="fas fa-times close"></i>
                            </div>
                            <div class="add-event-footer">
                            <button class="add-event">Add Event</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                

                           
                            
            </main>

            <!------------------------------ CUSTOMIZATION ------------------------------->

          
    <script src="main_page.js"></script>
    <script src="indexright.js"></script>
</body>
</html>
