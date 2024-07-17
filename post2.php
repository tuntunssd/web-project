<?php
@include 'config.php';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userid'];

    $sql = "INSERT INTO saves (userid) VALUES ('$userId')";
    if ($conn->query($sql) === TRUE) {
        header('Location: main_page2.php');
        exit();
    } else {
        echo "Error creating database entry: " . $conn->error;
    }

    $conn->close();
  
  }
?>
