<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'oss_checkout'; // Replace with your actual database name
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die('Could not connect to MySQL server: ' . mysqli_error($conn));
}

$orderMessage = ''; // Initialize the variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $price = $_POST['price'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $credit_card = mysqli_real_escape_string($conn, $_POST['credit_card']);

    // Insert data into the 'checkout' table
    $sql = "INSERT INTO `checkout` (`client`, `address`, `card`, `item`, `price`) VALUES ('$name', '$address', '$credit_card', '$item', '$price')";
    if (mysqli_query($conn, $sql)) {
        $orderMessage = 'Order submitted successfully!';
    } else {
        $orderMessage = 'Error: ' . mysqli_error($conn);
    }

    mysqli_close($conn); // Close the database connection
} else {
    // Redirect to shopping page if accessed directly
    header('Location: index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 40px; /* Increased margin-bottom for more space */
        }
        .message p {
            font-size: 18px;
            margin: 0;
        }
        .return-button {
            background-color: #0078d4;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        .return-button:hover {
            background-color: #005bb5;
        }
    </style>
</head>
<body>
    <div class="message">
        <p><?php echo htmlspecialchars($orderMessage); ?></p>
    </div>
    <form action="shop.html" method="get">
        <button type="submit" class="return-button">Return to Shop</button>
    </form>
</body>
</html>
