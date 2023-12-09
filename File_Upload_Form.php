<?php
//session_start();

include 'include/header.php';
require_once 'lib/db_php.php';
require_once 'lib/functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        /* Style to make the images smaller */
        img {
            max-width: 200px; /* Set the maximum width of the image */
            max-height: 200px; /* Set the maximum height of the image */
        }

        /* Style to create boxes around the images */
        .image-box {
            border: 1px solid #ccc; /* Border color and width */
            padding: 10px; /* Padding around the image */
            margin: 10px; /* Margin between boxes */
            display: inline-block; /* Display boxes in a row */
            background-color: #fff; /* Background color of the box */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Box shadow for a subtle lift */
            border-radius: 6px; /* Rounded corners */
            vertical-align: top; /* Align the boxes at the top of the line */
        }

        label {
            display: inline-block;
            margin-right: 10px;
        }

        a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
            margin-top: 5px;
            display: block;
        }

        a:hover {
            color: #ff4500;
        }

        hr {
            border: 1px solid #ccc;
            margin-top: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto; /* Center the container */
            background-color: #fff; /* Box background color */
            padding: 20px; /* Padding inside the box */
            border: 1px solid #ccc; /* Border around the box */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Box shadow for a subtle lift */
            border-radius: 8px; /* Rounded corners */
    </style>
</head>
<body>
    <div class="container">
        <form action="upload_file_render.php" method="post" enctype="multipart/form-data">
            <h1>Upload file here</h1>
        <label for="fileToUpload">Select file to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <br>
        <input type="submit" name="submit" value="Upload File">
        </form>
    </div>

<hr>

</body>

<!-- Display uploaded images with a delete option. -->
<?php
$files = scandir("uploads/");
foreach ($files as $file){
    // . looks through all files in the directory
    if($file !== "." && $file !== ".."){
        $filePath = "uploads/" . $file;
        echo "<div class='image-box'>";
        echo "<h1>{$file}</h1>";  // Display the actual file name here
        if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
            // If it's a PDF file, display a stock image
            echo "<img src='./images/PDF_file_icon.png' alt='PDF File'><br>";
        } else {
            // Display the uploaded image
            echo "<img src='{$filePath}' alt='Uploaded Image'><br>";
        }
        echo "<a href='upload_file_render.php?delete={$file}'>Delete</a>";
        echo "<a href='File_Edit_Form.php?edit={$file}'>Edit</a></div><hr>";
    }
}



function getRandomWord() {
    $words = ["Weeping Tom", "Spooderman", "I'll Tell You That Much", "Rupert's Scarf", "Lulu Orange", "River Lugia", "Tampa Ray", "You're Still Uploading Images?"];
    return $words[array_rand($words)];
}

function storeImage($filePath)
{
    $dbconn = db_connect();

    // Store the image file path in the database
    $query = "INSERT INTO images (image_path) VALUES ($1)";
    $result = pg_query_params($dbconn, $query, array($filePath));

    // Check if the query was successful
    if ($result) {
        echo "Image path successfully stored in the database";
    } else {
        echo "Error storing image path in the database: " . pg_last_error($dbconn);
    }

    // Close the database connection
    db_close($dbconn);
}
?>
<?php
// Include the footer file
include 'include/footer.php';
?>

</html>


