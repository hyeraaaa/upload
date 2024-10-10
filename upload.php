<?php
// Database configuration
$host = 'localhost'; // or your database host
$db = 'image_uploads';
$user = 'root'; // your database username
$pass = ''; // your database password

// Create a connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if an image was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $description = htmlspecialchars($_POST['description']);
        $image = $_FILES['image'];

        // Define the upload directory
        $uploadDir = 'uploads/';
        // Create the directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Get the file extension
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

        // Check if the file extension is allowed
        if (in_array(strtolower($ext), $allowedExt)) {
            // Create a unique filename
            $filename = uniqid('', true) . '.' . $ext;
            $uploadFilePath = $uploadDir . $filename;

            // Move the uploaded file to the upload directory
            if (move_uploaded_file($image['tmp_name'], $uploadFilePath)) {
                // Insert the file details into the database
                $stmt = $conn->prepare("INSERT INTO images (filename, description) VALUES (?, ?)");
                $stmt->bind_param("ss", $filename, $description);

                if ($stmt->execute()) {
                    echo "File uploaded successfully: " . $uploadFilePath . "<br>";
                    echo "Description: " . $description;
                } else {
                    echo "Failed to save details to database.";
                }

                $stmt->close();
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "Invalid file extension.";
        }
    } else {
        echo "No file uploaded or there was an upload error.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
