<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["avatar"])) {
    $target_directory = "uploads/";
    // Generate a unique file name using timestamp and a random number
    $unique_prefix = time() . '_' . rand(1000, 9999) . '_';
    $target_file = $target_directory . $unique_prefix . basename($_FILES["avatar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an image
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        setcookie('message', 'File is not an image.', time()+5);
        setcookie('isSuccess', '0', time()+5);
        $uploadOk = 0;
    }

    // Check the file size
    if ($_FILES["avatar"]["size"] > 500000) { // 500KB
        setcookie('message', 'Sorry, your file is too large.', time()+5);
        setcookie('isSuccess', '0', time()+5);
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
        setcookie('message', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.', time()+5);
        setcookie('isSuccess', '0', time()+5);
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        setcookie('message', 'Sorry, your file was not uploaded.', time()+5);
        setcookie('isSuccess', '0', time()+5);
    // If everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            $conn = new mysqli("localhost", "root", "root", "JustNews");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $username = $_COOKIE['user'];
            // Update the file path in the database
            $sql = "UPDATE users SET avatar='$target_file' WHERE name='$username'";

            if ($conn->query($sql) === TRUE) {
                setcookie('message', 'Avatar successfully updated.', time()+5);
                setcookie('isSuccess', '1', time()+5);
            } else {
                setcookie('message', 'Error updating avatar: ' . $conn->error, time()+5);
                setcookie('isSuccess', '0', time()+5);
            }

            $conn->close();
        } else {
            setcookie('message', 'Sorry, there was an error uploading your file.', time()+5);
            setcookie('isSuccess', '0', time()+5);
        }
    }
} else {
    setcookie('message', 'Invalid request.', time()+5);
    setcookie('isSuccess', '0', time()+5);
}

// Redirect back to the personal cabinet page
header('Location: kab.php');
exit;
?>