<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'oss_checkout';
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die('Could not connect to MySQL server: ' . mysqli_error($conn));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = intval($_POST['order_id']);

    // Delete the order from the 'checkout' table
    $sql = "DELETE FROM `checkout` WHERE `id` = $order_id";
    if (mysqli_query($conn, $sql)) {
        echo 'Order deleted successfully!';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }

    mysqli_close($conn); // Close the database connection
    header('Location: admin_order_management.php'); // Redirect back to the admin page
    exit();
} else {
    // Redirect to admin page if accessed directly
    header('Location: admin_order_management.php');
    exit();
}
?>
