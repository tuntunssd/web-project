<?php
@include 'config.php';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $video = $_POST['text'];

    $sql = "INSERT INTO study_material (user_id,video) VALUE ('$userId','$video')";
    if ($conn->query($sql) === TRUE) {
        header('Location: main_study.php');
        exit();
    } else {
        echo "Error creating database entry: " . $conn->error;
    }

    $conn->close();
  
  }
?>

