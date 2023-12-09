<!--// 1. Display common footer content-->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Link to the Bootstrap CSS library-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="../assets/styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<div class="footer">
    <div class="inner_footer">
        <div class="footer_container">
            <?php
            /*
            -------------------------------------
            File: footer.php
            -------------------------------------
            Purpose:
            - Conclude the HTML layout for the web application.
            - Optionally include JavaScript resources or close opened resources.
            - Print any common components or content that appear on the bottom of every page.

            To-Do:
            1. Display any consistent information or links typically found in footers.
            2. Close any opened tags or resources (e.g., closing tags from header.php).
            3. Optionally include JavaScript libraries or custom scripts.

            Remember to:
            - Ensure proper ordering if including multiple JavaScript files.
            - Consider responsiveness in any footer design.
            */

            // 1. Display common footer content
            echo "<div class='footer'>
    
                    <h2>Developers</h2>
                    
                    <p><span>&copy; " . date('Y') . " INFT-2100-Group 2, Rhys Thompson 100845373, Mercelena Erazo 100884604, Raisa Nasara 100887894.</span></p>
                    <!-- You can add more footer links or information here -->
                </div>";

            // 2. Close any opened tags or resources
            echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
                            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" 
                            crossorigin="anonymous"></script>';
            ?>
        </div>
    </div>
</div>
</body>
</html>

<style>
    /* Add styling for the footer logo */
    .footer-logo {
        vertical-align: middle; /* Align the image vertically with text */
        margin-right: 10px; /* Add some margin to the right of the image for spacing */
    }

    /* Add more styling for your footer as needed */
</style>
