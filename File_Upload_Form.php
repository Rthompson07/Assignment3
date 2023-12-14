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
$user_type = sanitize($_SESSION['user_type']);

if ($user_type === 'p') {
    // If user_type is "p", you can redirect them to another page or show an error message.
    header("Location: Warning.php"); // Replace with the appropriate URL
    exit;
} elseif ($user_type === 'v') {
    // If user_type is "p", you can redirect them to another page or show an error message.
    header("Location: Warning.php"); // Replace with the appropriate URL
    exit;
} elseif ($user_type === 'd') {
    // If user_type is "p", you can redirect them to another page or show an error message.
    header("Location: Warning.php"); // Replace with the appropriate URL
    exit;
}
elseif ($user_type === 'c') {
    // If user_type is "p", you can redirect them to another page or show an error message.
    header("Location: Warning.php"); // Replace with the appropriate URL
    exit;
}





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

    $allowedTypes = array("jpg", "png", "jpeg", "gif");

    foreach ($files as $file) {
        if ($file !== "." && $file !== "..") {
            // Get the file extension
            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

            // Check if the file extension is allowed
            if (in_array(strtolower($fileExtension), $allowedTypes)) {
                $fileCount++;
                $filePath = "uploads/" . $file;

                echo "<tr>";
                echo "<td>$fileCount</td>";
                echo "<td>$file</td>";
                echo "<td>$first_name $last_name</td>";
                echo "<td>";
                echo "<a href='upload_file_render.php?delete={$file}'>Delete</a>";
                echo " | ";
                echo "<a href='File_Edit_Form.php?edit={$file}'>Edit</a>";
                echo " | ";
                echo "<a href='#' onclick=\"openFileExplorer()\">Move</a>";

                // Hidden file input element
                echo "<input type='file' id='fileInput' style='display: none;'>";

                echo "<script>
                    function openFileExplorer() {
                        // Trigger the click event of the file input element
                        document.getElementById('fileInput').click();
                    }
                </script>";
                echo "</td>";
                echo "</tr>";
            } else {
                echo "<p>File $file has an invalid extension. Only JPG, PNG, JPEG, and GIF files are allowed.</p>";
            }
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




