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

// Fetch the order history from the database
$sql = "SELECT `id`, `client`, `address`, `card`, `item`, `price` FROM `checkout` ORDER BY `id` DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <style>
        .order {
            background-color: #d63232;
            height: 60px;
            width: 100%;
            border: 0;
        }
        .order div {
            display: flex;
            margin: 0 auto;
            width: 1000px;
            height: 100%;
            align-items: center;
        }
        .order div h1 {
            flex: 1;
            font-size: 24px;
            padding: 0;
            margin: 0;
            color: #eaebed;
            font-weight: normal;
        }
        .content {
            width: 1000px;
            margin: 0 auto;
        }
        .content h2 {
            margin: 0;
            padding: 25px 0;
            font-size: 22px;
            border-bottom: 1px solid #e0e0e3;
            color: #654343;
        }
        .content > div {
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1);
            margin: 25px 0;
            padding: 25px;
            background-color: #fff;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content table, .content table td, .content table th {
            border: 1px solid #e0e0e3;
        }
        .content table td, .content table th {
            padding: 10px;
        }
        .content table td:first-child, .content table th:first-child {
            font-weight: bold;
            color: #654343;
        }
        * {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
            font-size: 16px;
        }
        body.loggedin {
            background-color: #f3f4f7;
        }
        .delete-button {
			margin-top: 20px;
            background-color: #d9534f;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body class="loggedin">
    <div class="order">
        <div>
            <h1>Order Management</h1>
        </div>
    </div>
    <div class="content">
        <h2>Transaction</h2>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<form action="delete_order.php" method="post">';
                echo '<table>';
                echo '<tr><td>Username:</td><td>' . htmlspecialchars($row["client"]) . '</td></tr>';
                echo '<tr><td>Address:</td><td>' . htmlspecialchars($row["address"]) . '</td></tr>';
                echo '<tr><td>Item:</td><td>' . htmlspecialchars($row["item"]) . '</td></tr>';
                echo '<tr><td>Price:</td><td>$' . htmlspecialchars($row["price"]) . '</td></tr>';
                echo '<tr><td>Credit Card:</td><td>' . htmlspecialchars($row["card"]) . '</td></tr>';
                echo '</table>';
                echo '<input type="hidden" name="order_id" value="' . $row["id"] . '">';
                echo '<button type="submit" class="delete-button">Delete Order</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo '<p>No transaction history found.</p>';
        }
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
