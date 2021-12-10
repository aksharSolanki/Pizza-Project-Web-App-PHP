<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="pizzaStyles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Poppins:wght@200;400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Poppins:ital,wght@0,200;0,400;1,200&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    if ($_SESSION["pizzaType"] == "Pepperoni") {
        $src = "./images/pepperoni.jpeg";
    } else if ($_SESSION["pizzaType"] == "Hawaiian") {
        $src = "./images/hawaiian.jpeg";
    } else if ($_SESSION["pizzaType"] == "Cheese") {
        $src = "./images/cheese.jpeg";
    } else if ($_SESSION["pizzaType"] == "MeatLovers") {
        $src = "./images/meat.jpeg";
    } else if ($_SESSION["pizzaType"] == "Vegetarian") {
        $src = "./images/vegetarian.jpeg";
    }
    ?>
    <div id="wrapper">
        <h1 id="product-sans">Fresh Pizza</h1>
    </div>
    <h3 id="design">Designed by Akshar</h3><br>
    <h3>Order Confirmed</h3>
    <img src="<?php echo $src; ?>">
    <div id="wrapper">
        <div id="message">
            <h5>Dear <span><?php echo $_SESSION["customerName"]; ?></span>,<br>
                Thanks for having us deliver your fresh pizza.<br>
                Your support and trust in us are much appreaciated.<br>
                It will be delivered to <span><?php echo $_SESSION["customerAddress"]; ?>.</span><br>
                Postal code - <?php echo $_SESSION["addressCode"]; ?><br>
                You will receive promotion emails at <span><?php echo $_SESSION["customerEmail"]; ?></span><br>
                Phone number used for transaction : <span>+1 <?php echo $_SESSION["customerPhone"]; ?></span>
            </h5>
        </div>
        <div id="orderdetail">
            <h5>Order Details<h5>
                    <span><?php echo $_SESSION["pizzaSize"]; ?> pizza of </span>
                    <span><?php echo $_SESSION["pizzaType"]; ?> type.</span><br>
                    Amount received $<span><?php echo $_SESSION["amount"]; ?></span><br>
        </div>
    </div>
    <input id="submit" type="submit" name="btnSubmit" value="Order Again" onclick="location.href='home.php'" />
</body>

</html>