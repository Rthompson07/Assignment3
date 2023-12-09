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

        // Edit form
        echo "<form action='upload_file_render.php' method='post'>";
        echo "<label for='newFileName'>New File Name:</label>";
        echo "<input type='text' name='newFileName' value='{$file}'>";
        echo "<input type='hidden' name='oldFileName' value='{$file}'>";
        echo "<input type='submit' name='submitEdit' value='Save'>";
        echo "</form>";

        echo "<a href='upload_file_render.php?edit={$file}'>Edit</a></div><hr>";
    }
}

// Handle form submission for editing
if(isset($_POST['submitEdit']) && isset($_POST['newFileName']) && isset($_POST['oldFileName'])) {
    $newFileName = $_POST['newFileName'];
    $oldFileName = $_POST['oldFileName'];

    $oldFilePath = "uploads/" . $oldFileName;
    $newFilePath = "uploads/" . $newFileName;

    if(file_exists($oldFilePath)) {
        if(rename($oldFilePath, $newFilePath)) {
            echo "File name successfully updated";
        } else {
            echo "Error updating file name";
        }
    } else {
        echo "Error: File not found";
    }
}
?>
