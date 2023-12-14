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
    <form action="send_email.php" method="post" class="card card-body">
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
        <tr>
            <td height = "20" valign = "bottom">Attach File:</td>
        </tr>

        <tr baseline = "bottom">
            <td baseline = "bottom"><input name = "filea" type = "file" id = "filea" size = "16"></td>
        </tr>
        <button type="submit" class="btn btn-primary">Send Email</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
