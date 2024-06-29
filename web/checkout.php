<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $price = $_POST['price'];
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
    <title>Checkout Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .title {
            background-color: #2f3947;
            border: 0;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .title h1 {
            color: white;
        }
        .item {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .item label {
            display: block;
            margin-bottom: 10px;
        }
        .item input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .item button {
            background-color: #0078d4;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="title">
        <h1>Checkout Page</h1>
    </div>
    <div>
        <p>You are purchasing: <strong><?php echo htmlspecialchars($item); ?></strong></p>
    </div>
    <div>
        <p>Price: <strong>$<?php echo htmlspecialchars($price); ?></strong></p>
    </div>
    <div class="item">
        <form action="process_order.php" method="post">
            <input type="hidden" name="item" value="<?php echo htmlspecialchars($item); ?>">
            <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br>
            <label for="credit_card">Credit Card:</label>
            <input type="text" id="credit_card" name="credit_card" required><br>
            <button type="submit">Submit Order</button>
        </form>
    </div>
</body>
</html>
