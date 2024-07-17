<?php

@include 'config.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $userId = $_POST['user_id'];
        $tempFilePath = $_FILES['image']['tmp_name'];
        $originalFileName = $_FILES['image']['name'];
        
        $postText = $_POST['text'];
        // Create the uploads directory if it doesn't exist
        if (!is_dir('uploads/')) {
            mkdir('uploads/', 0755, true);  // Create with write permissions
        }

        // Move the uploaded file to a permanent location
        $uploadDir = 'uploads/';
        $newFileName = uniqid() . '_' . $originalFileName;
        $targetFilePath = $uploadDir . $newFileName;

        if (move_uploaded_file($tempFilePath, $targetFilePath)) {

            // Successfully moved the file
            // Perform additional processing (e.g., database entry) here
            
            

            $sql = "INSERT INTO newsbox (user_id, file_path, text) VALUES ('$userId', '$targetFilePath','$postText')";
            if ($conn->query($sql) === TRUE) {
                header('Location:main_Newsbox.php');
                exit();
            } else {
                echo "Error creating database entry: " . $conn->error;
            }

            $conn->close();
        } else {
            echo "Error uploading the image.";
        }
    } else {
        echo "No image uploaded.";
    }
}

?>
