<?php
//Header wont display navbar info
include 'include/headerlocked.php';

if (isset($_SESSION['user_authenticated']) && $_SESSION['user_authenticated'] === true) {
// User is authenticated, show the navigation bar
    include 'include/header.php';
}
?>

<!DOCTYPE html>

<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="./assets/styles.css" rel="stylesheet">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
<style>
    .terms {
        text-align: Center;

        text-decoration: underline;
    }

    .terms_dent{
        text-align: left;
        margin-left: 50px;
        text-decoration: underline;

    }
</style>


<div class="container mt-5">
    <h1><span class="terms">Acceptable Use Policy</span></h1>
    <p><span class="terms_dent"></span>Group 3 INFT-2100 Group 3</p>
</div>
    <?php
    $filename = 'policies/acceptable_use_policy.txt';

    // Check if the file exists
    if (file_exists($filename)) {
        // Read the content of the file
        $content = file_get_contents($filename);

        // Display the content
        echo '<pre>' . htmlspecialchars($content) . '</pre>';
    } else {
        // Display an error message if the file doesn't exist
        echo 'Terms of Service file not found.';
    }
    ?>


</body>

</html>


<!-- ============================= Start of Footer =============================
<?php
include 'include/footer.php';
?>
