<?php
//session_start();

include 'include/header.php';
require_once 'lib/db_php.php';
require_once 'lib/functions.php';

if (!isset($_SESSION['email_address'])) {
    // If not authenticated, redirect to the login page
    header("Location: sign-in.php");
    exit;
}

// Get user details from the session
$email_address = $_SESSION['email_address'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];

echo '<div class="alert alert-success" role="alert"> Welcome ' . $first_name . ' ' . $last_name .  '</div>';
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
// Handle file upload logic here
// ...

// Display the uploaded file information

echo '<div class="container">';

    echo '<p>File Name: ' . $_FILES["fileToUpload"]["name"] . '</p>';
    echo '<p>File Type: ' . $_FILES["fileToUpload"]["type"] . '</p>';
    echo '<p>File Size: ' . $_FILES["fileToUpload"]["size"] . ' bytes</p>';
    echo '<p>Uploaded By: ' . $first_name . ' ' . $last_name . '</p>';
    echo '</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload Gallery</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1, label {
            margin-bottom: 10px;
        }

        table {
            width: 80%; /* Set the width of the table */
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }



    </style>
</head>
<body>
<div class="container">
    <div class="btn-toolbar mb-2 mb-md-0">

    </div>

    <form action="upload_file_render.php" method="post" enctype="multipart/form-data">
        <div>
            <h1>Upload file here</h1>
        </div>
        <div>
            <label for="fileToUpload">Select file to upload:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <br>
            <input type="submit" name="submit" value="Upload File">
        </div>
    </form>
</div>

<hr>

<?php
$files = scandir("uploads/");
if (count($files) > 2) {
    echo '<h3>Uploaded File Information</h3>';
    echo '<table>';
    echo '<tr><th>File Number</th><th>File Name</th><th>Uploaded By</th><th>Action</th></tr>';
    $fileCount = 0;

    foreach ($files as $file) {
        if ($file !== "." && $file !== "..") {
            $fileCount++;
            $filePath = "uploads/" . $file;

            echo "<tr>";
            echo "<td>{$fileCount}</td>";
            echo "<td>{$file}</td>";
            echo "<td>{$first_name} {$last_name}</td>";
            echo "<td>";
            echo "<a href='upload_file_render.php?delete={$file}'>Delete</a>";
            echo " | ";
            echo "<a href='File_Edit_Form.php?edit={$file}'>Edit</a>";
            echo " | ";
            echo "<a href='upload_file_render.php?move={$file}'>Move</a>";
            echo "</td>";

            echo "</tr>";
        }
    }

    echo '</table>';
} else {
    echo '<p>No files uploaded yet.</p>';
}
?>

<?php
// Include the footer file
include 'include/footer.php';
?>
</body>
</html>




