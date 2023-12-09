<?php
include 'include/header.php';
require_once 'lib/db_php.php';
require_once 'lib/functions.php';

// Check if the user is authenticated
if (!isset($_SESSION['email_address'])) {
    // Not authenticated, redirect to login
    header("Location: sign-in.php");
    exit;
}

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted
    if (isset($_FILES["uploadedImage"])) {
        // Define the target directory for uploaded images
        $targetDirectory = "uploads/";

        // Generate a unique filename for the uploaded image
        $targetFileName = $targetDirectory . uniqid() . '_' . basename($_FILES["uploadedImage"]["name"]);

        // Move the uploaded image to the target directory
        if (move_uploaded_file($_FILES["uploadedImage"]["tmp_name"], $targetFileName)) {
            // Update the user's profile picture information in the session
            $_SESSION['profile_picture'] = $targetFileName;
        } else {
            // Handle the case where the file upload failed
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Get user details from the session
$email_address = $_SESSION['email_address'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .upload-form {
            max-width: 480px;
            margin: 150px auto;
            padding: 30px;
            border: 1px solid #e2e2e2;
            border-radius: 5px;
            background: white;
        }

        .form-control-file {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: .375rem .75rem;
        }

        .profile-picture-box {
            width: 150px; /* Set the width of the box */
            height: 150px; /* Set the height of the box */
            border: 1px solid #ccc; /* Add a border to the box */
            overflow: hidden; /* Hide any overflowing content */
            display: block; /* Display the box as a block element */
            margin-bottom: 20px; /* Add some bottom margin for spacing */
        }

        .profile-picture {
            width: 100%; /* Make the image fill the entire container */
            height: auto; /* Maintain the image's aspect ratio */
            display: block; /* Remove any extra spacing below the image */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="upload-form mt-4">
        <div class="profile-picture-box">
            <img src="<?php echo isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'images/profilepictemp.jpg'; ?>" alt="Profile Picture" class="profile-picture">
        </div>


        <h4 class="mb-3">Upload an Image</h4>
        <form action="upload_pfp_page.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="uploadedImage">Select image to upload (JPEG, PNG, or GIF):</label>
                <input type="file" class="form-control-file" name="uploadedImage" id="uploadedImage" accept=".jpeg, .jpg, .png, .gif" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload Image</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Include the footer
include 'include/footer.php';
?>
