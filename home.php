<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "UsersPizzaSystem";
$table_Name = "userAccounts";

//CHECK IF TABLE EXISTS
function checkTable($server_name, $user_name, $password, $db_name, $conn, $sql_query, $table_Name)
{
    //CREATE NEW CONNECTION
    $conn = mysqli_connect($server_name, $user_name, $password, $db_name);
    $sql_query = "
                    CREATE TABLE IF NOT EXISTS $table_Name (
                            customer_id int NOT NULL AUTO_INCREMENT,
                            name varchar(30) NOT NULL,
                            address varchar(30),
                            post_code varchar(6) NOT NULL,
                            email varchar(40) NOT NULL,
                            phone numeric(10) NOT NULL,
                            account_created DATE NOT NULL,
                            PRIMARY KEY(customer_id) 
                    );
                    ";
    mysqli_query($conn, $sql_query);
    return $conn;
}

//CHECK IF DATABASE EXISTS
function checkDB($server_name, $user_name, $password, $db_name)
{
    //MAKING CONNECTION TO CREATE DATABASE IF DOESN'T EXIST
    $conn = mysqli_connect($server_name, $user_name, $password);
    $sql_query = "CREATE DATABASE $db_name;";
    mysqli_query($conn, $sql_query);
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Enter Details</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Poppins:wght@200;400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Poppins:ital,wght@0,200;0,400;1,200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="pizzaStyles.css">
</head>

<body>
    <?php
    session_start();
    //VARIABLES TO HOLD VALUES
    $customerName = "";
    $customerAddress = "";
    $addressCode = "";
    $customerEmail = "";
    $customerPhone = "";

    //VARIABLES TO DISPLAY ERROR
    $nameErr = "";
    $codeErr = "";
    $emailErr = "";
    $phoneErr = "";

    //ORDER BUTTON FUNCTIONALITY
    if (isset($_POST['btnSubmit'])) {
        $flag = true;
        //VALIDATE INPUT NAME
        if (empty($_POST['customerName'])) {
            $nameErr = "Name required";
            $flag = false;
        } else {
            $customerName = test_input($_POST['customerName']);
        }

        //VALIDATE INPUT CODE
        if (empty($_POST['addressCode'])) {
            $codeErr = "Postal code required";
            $flag = false;
        } else {
            $addressCode = test_input($_POST['addressCode']);
        }

        //VALIDATE INPUT EMAIL
        if (empty($_POST['customerEmail'])) {
            $emailErr = "Email required";
            $flag = false;
        } else {
            $customerEmail = test_input($_POST['customerEmail']);
        }

        //VALIDATE INPUT PHONE
        if (empty($_POST['customerPhone'])) {
            $phoneErr = "Phone required";
            $flag = false;
        } else {
            $customerPhone = test_input($_POST['customerPhone']);
        }
        $customerAddress = test_input($_POST['customerAddress']);


        if ($flag) {
            $conn = mysqli_connect($server_name, $user_name, $password, $db_name);
            //CHECK DATABASE AND TABLE
            CheckDB($server_name, $user_name, $password, $db_name);
            CheckTable($server_name, $user_name, $password, $db_name, $conn, $sql_query, $table_Name);

            //INSERT CUSTOMER INFO INTO THE DATABASE
            $sql_query = "INSERT INTO userAccounts (name, address, post_code, email, phone, account_created)
                            VALUES ('$customerName', '$customerAddress', '$addressCode', '$customerEmail', '$customerPhone', now());";

            //FOR TESTING
            if (mysqli_query($conn, $sql_query)) {
                $nameErr = "Successfully inserted the record.";
            } else {
                $nameErr = "Error while inserting the record: " . mysqli_error($conn);
            }

            //DATA PASSED ACROSS PAGES USING SESSION
            $_SESSION["customerName"] = $customerName;
            $_SESSION["customerAddress"] = $customerAddress;
            $_SESSION["addressCode"] = strtoupper($addressCode);
            $_SESSION["customerEmail"] = $customerEmail;
            $_SESSION["customerPhone"] = $customerPhone;
            header('location:orderpizza.php');
            exit();
        }
    }

    //TESTING INPUT
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <div id="wrapper">
        <h1 id="product-sans">Fresh Pizza</h1>
        <h2>Order the freshest pizza in town.
            <br>Get it delivered with zero contact.
        </h2>
    </div>
    <h3 id="design">Designed by Akshar</h3>
    <h3>Enter Your Details</h3>
    <form method="post">
        <input type="text" name="customerName" placeholder="Name" />
        <span id="err">*<?php echo $nameErr; ?></span>
        <br>
        <input type="text" name="customerAddress" placeholder="Address" />
        <br>
        <input type="text" name="addressCode" placeholder="Postal Code" />
        <span id="err">*<?php echo $codeErr; ?></span>
        <br>
        <input type="text" name="customerEmail" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" placeholder="Email" />
        <span id="err">*<?php echo $emailErr; ?></span>
        <br>
        <input type="tel" name="customerPhone" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="Phone" />
        <span id="err">*<?php echo $phoneErr; ?></span>
        <br><br>
        <input id="submit" type="submit" name="btnSubmit" value="Order Now" />
    </form>
</body>

</html>