<?php
ob_start();
$targetDir = "uploads/";

// handling deletion
if(isset($_GET["delete"])){
    $fileToDelete = $targetDir . basename($_GET["delete"]);
    if(file_exists($fileToDelete)){
        unlink($fileToDelete);
        header("Location: File_Upload_Form.php");
        exit;
    }else{
        echo "Error: File not found";
    }
}

// handle file upload
if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"])){
    $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));

    // Check for file size
    $uploadOk = 1;
    if($_FILES["fileToUpload"]["size"] > 5000000){
        echo "Sorry, your file is too large";
        $uploadOk = 0;
    }

    // Check for allowed file types - images only
    $allowedImageTypes = array("jpg", "png");
    $allowedPdfTypes = array("pdf");

    if(in_array($fileType, $allowedImageTypes)){
        // Handling image upload
        if($uploadOk == 0){
            echo "Sorry, we could not upload your image file";
        }else{
            $newFileName = uniqid() . '.' . $fileType; // rename the image file here
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetDir . $newFileName)){
                echo "The image file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been successfully uploaded";
                header("Location: File_Upload_Form.php");
                exit;
            }else{
                echo "Sorry, there was an error uploading your image file";
            }
        }
    } elseif (in_array($fileType, $allowedPdfTypes)) {
        // Handling PDF upload
        if($uploadOk == 0){
            echo "Sorry, we could not upload your PDF file";
        }else{
            $newFileName = uniqid() . '.' . $fileType; // rename the PDF file here
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetDir . $newFileName)){
                echo "The PDF file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been successfully uploaded";
                header("Location: File_Upload_Form.php");
                exit;
            }else{
                echo "Sorry, there was an error uploading your PDF file";
            }
        }
    } else {
        echo "Sorry, only PDF, JPG, and PNG files are allowed";
    }
}

// Add a "Return to Form" button with indentation
echo '<br><button style="margin-left: 20px;"><a href="File_Upload_Form.php" style="text-decoration: none; color: inherit;">Return to Form</a></button>';
?>
