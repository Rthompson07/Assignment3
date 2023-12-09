<?php


//include header and libraries
include 'include/headerlocked.php';
require_once 'lib/db_php.php';
require_once 'lib/functions.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // sanitize incoming parameters
    $email_address = filter_var(trim($_POST['email_address']), FILTER_SANITIZE_EMAIL);
    $first_name = sanitize($_POST['first_name']);
    $last_name = sanitize($_POST['last_name']);
    $plainPassword = trim($_POST['password']);
    $phone_extension = $_POST['phone_extension'];
    $user_type = $_POST['user_type'];

    // validation
    if(!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        // store message in session
        setFlashMessage("Invalid email provided");

    }
    else {
        try {
            // hash password
            $password = hash_password($plainPassword);

            // register user
            $result = registerUser($email_address, $first_name, $last_name, $password, $phone_extension, $user_type);

            if($result){
                redirect("sign-in.php");
            }else{
                setFlashMessage("Registration failed. Please try again.");
                logEvent();
            }
        }catch (Exception $e){
            setFlashMessage($e->getMessage());
        }
    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h1>INFT2100 - User Registration</h1>

        <!--Display flash message -->
        <?php
        if(hasFlashMessage()){
            echo '<div class="alert alert-danger" role="alert">' . getFlashMessage() . '</div>';
            removeFlashMessage(); //clear message
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="bg-light p-5 rounded">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email_address" name="email_address" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <label for="phone_extension">Phone Extension:</label>
                <input type="tel" name="phone_extension" class="form-control" placeholder="Enter Phone Extension">
            </div>
            <div class="form-group mb-3">
                <label for="user_type">User Type:</label>
                <select name="user_type" class="form-control">
                    <option value="a">Agent</option>
                    <option value="c">Client</option>
                    <option value="s">Super Admin (Hero)</option>
                    <option value="p">Pending User</option>
                    <option value="d">Discharged</option>
                    <option value="v">Villain</option>
                </select>
                <button type="submit" class="btn btn-primary">Register</button>
                <a href="index.php" class="btn btn-secondary">Return to Index</a>
            </div>

                </div>
            </div>

        </form>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

<!-- ============================= Start of Footer ============================= -->
<?php
include 'include/footer.php';
?>

