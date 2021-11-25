<!DOCTYPE html>
<html>
<head>
    <title>Order Fresh Pizza</title>
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
    $pizzaSize = "";
    $pizzaType = "";
    $sizeErr = "";
    $typeErr = "";
    if (isset($_POST['btnOrder'])) {
        $flag = true;
        if (!isset($_POST['size'])) {
            $sizeErr = "Please select the size";
            $flag = false;
        } else {
            $pizzaSize = $_POST['size'];
        }
        if (!isset($_POST['type'])) {
            $typeErr = "Please select the type";
            $flag = false;
        } else {
            $pizzaType = $_POST['type'];
        }
        if ($flag) {
            $amount = calculateAmount($pizzaSize, $pizzaType);
            $_SESSION["amount"] = $amount;
            $_SESSION["pizzaSize"] = ucfirst($pizzaSize);
            $_SESSION["pizzaType"] = ucfirst($pizzaType);
            header('location:confirmation.php');
            exit();
        }
    }
    function calculateAmount($pizzaSize, $pizzaType)
    {
        $amount = 0;
        //PRICES FOR SMALL PIZZA
        if ($pizzaSize == "small") {
            if ($pizzaType == "pepperoni") {
                $amount = 10;
            } else if ($pizzaType == "hawaiian") {
                $amount = 10;
            } else if ($pizzaType == "cheese") {
                $amount = 7;
            } else if ($pizzaType == "meatLovers") {
                $amount = 20;
            } else if ($pizzaType == "vegetarian") {
                $amount = 8;
            }
            //PRICES FOR MEDIUM PIZZA
        } else if ($pizzaSize == "medium") {
            if ($pizzaType == "pepperoni") {
                $amount = 18;
            } else if ($pizzaType == "hawaiian") {
                $amount = 15;
            } else if ($pizzaType == "cheese") {
                $amount = 10;
            } else if ($pizzaType == "meatLovers") {
                $amount = 25;
            } else if ($pizzaType == "vegetarian") {
                $amount = 14;
            }
            //PRICES FOR LARGE PIZZA  
        } else if ($pizzaSize == "large") {
            if ($pizzaType == "pepperoni") {
                $amount = 25;
            } else if ($pizzaType == "hawaiian") {
                $amount = 22;
            } else if ($pizzaType == "cheese") {
                $amount = 15;
            } else if ($pizzaType == "meatLovers") {
                $amount = 30;
            } else if ($pizzaType == "vegetarian") {
                $amount = 18;
            }
            //PRICES FOR FAMILY PIZZA
        } else if ($pizzaSize == "family") {
            if ($pizzaType == "pepperoni") {
                $amount = 30;
            } else if ($pizzaType == "hawaiian") {
                $amount = 25;
            } else if ($pizzaType == "cheese") {
                $amount = 20;
            } else if ($pizzaType == "meatLovers") {
                $amount = 35;
            } else if ($pizzaType == "vegetarian") {
                $amount = 22;
            }
        }
        return $amount;
    }
    ?>
    <div id="wrapper">
        <h1 id="product-sans">Fresh Pizza</h1>
        <h2>Order the freshest pizza in town.
            <br>Get it delivered with zero contact.
        </h2>
    </div>
    <h3 id="design">Designed by Akshar</h3>
    <h3>Make your pizza your way</h3>

    <form method="post">
        <!-- PIZZA SIZE -->
        <div id="make">
            <div id="size">
                <h4>Select size</h4><span><?php echo $sizeErr; ?></span>
                <input id="getsize" type="radio" name="size" value="small" required />
                <label>Small</label><br>
                <input id="getsize" type="radio" name="size" value="medium" required />
                <label>Medium</label><br>
                <input id="getsize" type="radio" name="size" value="large" required />
                <label>Large</label><br>
                <input id="getsize" type="radio" name="size" value="family" required />
                <label>Family</label><br>
            </div>

            <!-- PIZZA TYPE -->
            <div id="type">
                <h4>Select Pizza Type</h4><span><?php echo $typeErr; ?></span>
                <select id="drop" name="type">
                    <option value="select">Select</option>
                    <option value="pepperoni" require>Pepperoni</option>
                    <option value="hawaiian" require>Hawaiian</option>
                    <option value="cheese" require>Cheese</option>
                    <option value="meatLovers" require>Meat Lovers</option>
                    <option value="vegetarian" require>vegetarian</option>
                </select>
            </div>
        </div>
            <div>
                <input id="submit" type="submit" name="btnOrder" value="Order Now">
            </div>
    </form>
</body>

</html>