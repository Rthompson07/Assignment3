<?php
//session_start();

include 'include/header.php';
require_once 'lib/db_php.php';
require_once 'lib/functions.php';
?>

<div class="container">
    <h2 class="mb-4">Compose Email</h2>
    <form action="send_email.php" method="post" class="card card-body">
        <div class="form-group">
            <label for="sender">From:</label>
            <input type="email" name="sender" value="<?php echo $_SESSION['email_address']; ?>" class="form-control">
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
        <div>
            <label for="fileToAttach">Select file to attach:</label>
            <input type="file" name="fileToAttach" id="fileToAttach">
        </div>
        <button type="submit" class="btn btn-primary">Send Email</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<?php
// Include the footer file
include 'include/footer.php';
?>
</body>
</html>
