<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Access Denied</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }

        .warning-container {
            text-align: center;
            padding: 20px;
            border: 2px solid #dc3545;
            border-radius: 8px;
            background-color: #f8d7da;
            color: #721c24;
        }

        h1 {
            color: #721c24;
        }

        .redirect-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="warning-container">
    <h1>Warning!</h1>
    <p>You do not have access to this page.</p>
    <a href="dashboard.php" class="redirect-button">Return</a>
</div>
</body>
</html>
