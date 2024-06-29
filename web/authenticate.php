<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (!isset($_POST['username'], $_POST['password'])) {
    // Could not get the data that should have been sent.
    exit('Please fill both the username and password fields!');
}

// Vulnerable to SQL injection (for demonstration only)
$sql = "SELECT id, password FROM accounts WHERE username = '{$_POST['username']}' AND password = '{$_POST['password']}'";
echo "SQL Query: " . $sql . PHP_EOL . "<br>";

// Execute the query
$result = mysqli_query($con, $sql);

// Check if there is a result
if ($result) {
    // Store the result so we can check if the account exists in the database.
    $row = mysqli_fetch_assoc($result);
    if ($row) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $row['id'];
            header('Location: home.php');
            exit;
    } else {
        echo 'Incorrect username and/or password!';
    }
} else {
    // Error in executing the query
    echo 'Error: ' . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>
