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

?>
<?php
// Include the footer file
include 'include/footer.php';
?>

</html>


