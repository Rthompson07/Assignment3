<?php
//
//require_once 'config/constants.php';
//require_once 'lib/db_php.php';
//
//
//if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['uploadedImage'])) {
//    $imageFileType = strtolower(pathinfo($_FILES['uploadedImage']['name'], PATHINFO_EXTENSION));
//
//    if (getimagesize($_FILES['uploadedImage']['tmp_name']) === false) {
//        die("File is not an image");
//    }
//
//    $target_dir = 'uploads/';
//    $target_file = $target_dir . uniqid() . '.' . $imageFileType;
//
//    switch ($imageFileType) {
//        case 'jpg':
//        case 'jpeg':
//            $image = imagecreatefromjpeg($_FILES['uploadedImage']['tmp_name']);
//            break;
//        case 'gif':
//            $image = imagecreatefromgif($_FILES['uploadedImage']['tmp_name']);
//            break;
//        case 'png':
//            $image = imagecreatefrompng($_FILES['uploadedImage']['tmp_name']);
//            break;
//
//        default:
//            die("Sorry, only jpg/jpeg png, of gif files are allowed for upload");
//    }
//
//    //Convert Image to png and save it with max compression
//    $compressed_png = $target_dir . uniqid() . '.png';
//    imagepng($image, $compressed_png, 9);
//
//    // release the memory associated with the image resource at its no longer needed
//    imagedestroy($image);
//
//    // store the path of the compressed image in the POSTGRES database
//    storeImage($compressed_png);
//} else {
//    echo "No image has been uploaded";
//
//}
//
//function storeImage($filePath){
//
//    $dbconn = db_connect();
//
//    // Store image file in the datbase
//    $query = "INSERT INTO images (image_path) VALUES ($1)";
//    $result = pg_query_params($dbconn, $query, array($filePath));
//
//    if($result){
//        echo "Image path stored in the database successfully! ";
//        echo '<img src="' . $filePath . '" alt="Uploaded Image">';
//
//    }else{
//        echo "An error occurred while storing the image path";
//    }
//
//    pg_close($dbconn);
//}