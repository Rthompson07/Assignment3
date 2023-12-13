<?php
$files = scandir("uploads/");
foreach ($files as $file) {
    // . looks through all files in the directory
    if ($file !== "." && $file !== "..") {
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

        // Edit form
        echo "<form action='File_Upload_Form.php' method='post'>";
        echo "<label for='newFileName'>New File Name:</label>";
        echo "<input type='text' name='newFileName' value='{$file}'>";
        echo "<input type='hidden' name='oldFileName' value='{$file}'>";
        echo "<input type='submit' name='submitEdit' value='Save'>";
        echo "</form>";

        echo "</div><hr>";
    }
}

// Handle form submission for editing
if (isset($_POST['submitEdit']) && isset($_POST['newFileName']) && isset($_POST['oldFileName'])) {
    $newFileName = $_POST['newFileName'];
    $oldFileName = $_POST['oldFileName'];

    $oldFilePath = "uploads/" . $oldFileName;
    $newFilePath = "uploads/" . $newFileName;

    if (file_exists($oldFilePath)) {
        if (rename($oldFilePath, $newFilePath)) {
            // Redirect back to File_Upload_Form.php with the updated file name
            header("Location: File_Upload_Form.php?updatedFileName=$newFileName");
            exit;
        } else {
            echo "Error updating file name";
        }
    } else {
        echo "Error: File not found";
    }
}
?>
