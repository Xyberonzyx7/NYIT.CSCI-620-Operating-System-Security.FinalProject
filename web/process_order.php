<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'oss_checkout'; // Replace with your actual database name
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die('Could not connect to MySQL server: ' . mysqli_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $price = $_POST['price'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $credit_card = mysqli_real_escape_string($conn, $_POST['credit_card']);

    // Insert data into the 'checkout' table
    $sql = "INSERT INTO `checkout` (`client`, `address`, `card`, `item`, `price`) VALUES ( '$name', '$address', '$credit_card', '$item', '$price')";
    if (mysqli_query($conn, $sql)) {
        echo 'Order submitted successfully!';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }

    mysqli_close($conn); // Close the database connection
} else {
    // Redirect to shopping page if accessed directly
    header('Location: index.html');
    exit();
}
?>
