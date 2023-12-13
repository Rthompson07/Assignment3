<?php

// Your file directory
$filesDirectory = "uploads/";

// Handle form submission for editing file names
if (isset($_POST['submitEdit']) && isset($_POST['newFileName']) && isset($_POST['oldFileName'])) {
    $newFileName = $_POST['newFileName'];
    $oldFileName = $_POST['oldFileName'];

    // Validate new file name (you may want to add more validation)
    if (!empty($newFileName) && preg_match("/^[a-zA-Z0-9]+(\.(jpg|pdf|png))?$/", $newFileName)) {
        $oldFilePath = $filesDirectory . $oldFileName;
        $newFilePath = $filesDirectory . $newFileName;

        if (file_exists($oldFilePath)) {
            // Check if the new file name already exists
            if (!file_exists($newFilePath)) {
                if (rename($oldFilePath, $newFilePath)) {
                    header("Location: http://localhost:8080/Assignment3/upload_file_render.php");
                } else {
                    echo "Error updating file name";
                }
            } else {
                echo "Error: The file name '$newFileName' already exists. Choose a different name.";
            }
        } else {
            echo "Error: File not found";
        }
    } else {
        echo "Error: Invalid or empty file name. Please enter a valid file name with extension (.jpg, .pdf, .png).";
    }
}

// Display existing files and the edit form
$files = scandir($filesDirectory);
foreach ($files as $file) {
    if ($file !== "." && $file !== "..") {
        $filePath = $filesDirectory . $file;
        echo "<div class='image-box'>";
        echo "<h1>{$file}</h1>";  // Display the actual file name here
        if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
            // If it's a PDF file, display a stock image
            echo "<img src='./images/PDF_file_icon.png' alt='PDF File' style='width: 100px; height: 100px;'><br>";
        } else {
            // Display the uploaded image
            echo "<img src='{$filePath}' alt='Uploaded Image' style='width: 100px; height: 100px;'><br>";
        }

        // Edit form
        echo "<form action='File_Edit_Form.php' method='post'>";
        echo "<label for='newFileName'>New File Name:</label>";
        echo "<input type='text' name='newFileName' value='{$file}'>";
        echo "<input type='hidden' name='oldFileName' value='{$file}'>";
        echo "<input type='submit' name='submitEdit' value='Save'>";
        echo "</form>";

        echo "</div><hr>";
    }
}


?>
