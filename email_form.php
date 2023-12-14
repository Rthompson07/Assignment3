<!DOCTYPE html>
<html>
<head>
    <title>Send Emails</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">Compose Email</h2>
    <form action="send_email.php" method="post" enctype="multipart/form-data" class="card card-body">
        <div class="form-group">
            <label for="sender">From:</label>
            <input type="email" name="sender" required class="form-control">
        </div>
        <div class="form-group">
            <label for="recipient">To:</label>
            <input type="email" name="recipient" required class="form-control">
        </div>
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" class="form-control">
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message" rows="5" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="fileToUpload">Attach File:</label>
            <input type="file" name="fileToUpload">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Send Email</button>
    </form>

    <?php
    if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"])){
        $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));

        // Check for file size
        $uploadOk = 1;
        if($_FILES["fileToUpload"]["size"] > 5000000){
            echo "<p>Sorry, your file is too large.</p>";
            $uploadOk = 0;
        }

        // Check for allowed file types - images and PDFs only
        $allowedImageTypes = array("jpg", "png");
        $allowedPdfTypes = array("pdf");

        if (!in_array($fileType, array_merge($allowedImageTypes, $allowedPdfTypes))) {
            echo "<p>Invalid file type. Only JPG, PNG, and PDF files are allowed.</p>";
            $uploadOk = 0;
        }
    }
    ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
