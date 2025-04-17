<?php
// Include the database connection
include('dbconn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $Title = isset($_POST['Title']) ? $_POST['Title'] : null;
    $Description = isset($_POST['Description']) ? $_POST['Description'] : null;
    $Link = isset($_POST['Link']) ? $_POST['Link'] : null;
    $Media = isset($_FILES['Media']) ? $_FILES['Media'] : null;

    // Check if any fields are empty
    if (empty($Title) || empty($Description) || empty($Link) || empty($Media['name'])) {
        echo "All fields are required.";
    } else {
        // Define the upload directory (ensure this is relative or absolute)
        $uploadDir = 'uploads/';
        
        // Check if the uploads directory exists, if not, create it
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);  // Create the directory if it doesn't exist
        }

        // Check if the directory is writable
        if (!is_writable($uploadDir)) {
            echo "Uploads directory is not writable.";
            exit;
        }

        // Generate a unique filename to avoid overwriting existing files
        $uploadFile = $uploadDir . uniqid() . '-' . basename($Media['name']);

        // Validate the file type (optional, enhance security)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4'];
        if (!in_array($Media['type'], $allowedTypes)) {
            echo "Invalid file type. Please upload an image or video.";
            exit;
        }

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($Media['tmp_name'], $uploadFile)) {
            // File uploaded successfully

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO content (Title, Description, Link, Media) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $Title, $Description, $Link, $uploadFile);

            // Execute the prepared statement
            if ($stmt->execute()) {
                echo "Form submitted successfully! Pin created and file uploaded to: " . $uploadFile;
                header("location:profil1.php");
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Failed to upload file.";
        }
    }
}

// Close the database connection
$conn->close();
?>
