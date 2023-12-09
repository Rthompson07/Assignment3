<?php
include 'include/header.php';

$price = 150.00;
$hstRate = 0.13; // HST rate (13% in Ontario, for example)
$totalAmount = $price + ($price * $hstRate);

$price2 = 160.00;
$hstRate2 = 0.13; // HST rate (13% in Ontario, for example)
$totalAmount = $price2 + ($price2 * $hstRate2);

$price3 = 240.00;
$hstRate3 = 0.13; // HST rate (13% in Ontario, for example)
$totalAmount = $price3 + ($price3 * $hstRate3);
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        body {
            text-align: center; /* Center the content horizontally */
        }

        .product-container {
            display: inline-block; /* Align the container to the center */
            text-align: left; /* Align text within the container to the left */
            margin-bottom: 1px; /* Add margin at the bottom to move the footer down */
        }

        .product-box {
            width: 450px;
            height: 370px;
            margin-left: 700px;
            padding: 20px;
            border: 1px solid #ccc;
            text-align: center;
            box-shadow: 2px 2px 6px  rgba(0,0,0,0.20);
        }

        .product-box h1 {
            margin-bottom: 15px;
        }

        .product-content img {
            display: block;
            margin: 0 auto;
            max-width: 100%;

        }

        .product-content p {
            margin-top: 50px;
        }

        .product-box img{
            max-width: 100%; /* Set the maximum width to 100% of the container */
            max-height: 150px; /* Set the maximum height to a specific value */
            display: block;
            margin: 0 auto;
        }

        /* Additional style for the footer */

    </style>
</head>
<body>

<!-- First Form -->
 <div class="product-container">
    <div class="product-box">
    <h1>Way Of Wade South Beach 10's</h1>
    <img src="images/wowSouthBeach10.jpg" alt="shoe">
    <p>&nbsp;&nbsp;&nbsp;$<?php echo number_format($price, 2); ?> CAN (including HST)</p>

    <!-- PayPal payment button form -->
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <!-- TODO: Replace this email with your sandbox email -->
        <input type="hidden" name="business" value="sb-qhwza28197595@business.example.com">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="item_name" value="Product XYZ">
        <input type="hidden" name="amount" value="<?php echo $totalAmount;?>">
        <input type="hidden" name="currency_code" value="CAD">
        <input type="hidden" name="return" value="<?php echo NGROK_URL;?>/Assignment2/success.php">
        <input type="hidden" name="cancel_return" value="<?php echo NGROK_URL?>/Assignment2/cancel.php">
        <input type="hidden" name="notify_url" value="<?php echo NGROK_URL?>/Assignment2/ipn_listener.php">
        <input type="image" name="submit" border="0"
               src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
               alt="PayPal - The safer, easier way to pay online">
        <img alt="" border="0" width="1" height="1"
             src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
    </form>
    </div>


    <!-- Second Form -->
    <div class="product-box">
    <h1>PUMA x LAMELO BALL MB.03</h1>
    <img src="images/lemeloshoes.03.jpg"" alt="shoe">
    <p>&nbsp;&nbsp;&nbsp;$<?php echo number_format($price2, 2); ?> CAN (including HST)</p>

    <!-- PayPal payment button form -->
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <!-- TODO: Replace this email with your sandbox email -->
        <input type="hidden" name="business" value="sb-qhwza28197595@business.example.com">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="item_name" value="Product XYZ">
        <input type="hidden" name="amount" value="<?php echo $totalAmount;?>">
        <input type="hidden" name="currency_code" value="CAD">
        <input type="hidden" name="return" value="<?php echo NGROK_URL;?>/Assignment2/success.php">
        <input type="hidden" name="cancel_return" value="<?php echo NGROK_URL?>/Assignment2/cancel.php">
        <input type="hidden" name="notify_url" value="<?php echo NGROK_URL?>/Assignment2/ipn_listener.php">
        <input type="image" name="submit" border="0"
               src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
               alt="PayPal - The safer, easier way to pay online">
        <img alt="" border="0" width="1" height="1"
             src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
    </form>
    </div>


    <div class="product-box">
    <h1>Lebron James Witness VII</h1>
    <img src="images/nike_witness.jpg" alt="shoe">
    <p>&nbsp;&nbsp;&nbsp;$<?php echo number_format($price3, 2); ?> CAN (including HST)</p>

    <!-- PayPal payment button form -->
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <!-- TODO: Replace this email with your sandbox email -->
        <input type="hidden" name="business" value="sb-qhwza28197595@business.example.com">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="item_name" value="Lebron James Witness VII">
        <input type="hidden" name="amount" value="<?php echo $totalAmount;?>">
        <input type="hidden" name="currency_code" value="CAD">
        <input type="hidden" name="return" value="<?php echo NGROK_URL;?>/Assignment2/success.php">
        <input type="hidden" name="cancel_return" value="<?php echo NGROK_URL?>/Assignment2/cancel.php">
        <input type="hidden" name="notify_url" value="<?php echo NGROK_URL?>/Assignment2/ipn_listener.php">
        <input type="image" name="submit" border="0"
               src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
               alt="PayPal - The safer, easier way to pay online">
        <img alt="" border="0" width="1" height="1"
             src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
    </form>
 </div>


</body>
</html>

<?php
include 'include/footer.php';
?>
