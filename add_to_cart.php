<?php
// Check if the product name and price are received
if (isset($_POST['productName']) && isset($_POST['productPrice'])) {
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];

    // Establish a database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sahanapharmacy";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Start the session if it's not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the cart exists in the session
    if (!isset($_SESSION['cart'])) {
        // Create a new cart array if it doesn't exist
        $_SESSION['cart'] = array();
    }

    // Add the product to the cart array
    $product = array(
        'name' => $productName,
        'price' => $productPrice
    );
    $_SESSION['cart'][] = $product;

    // Get the email from the session (assuming the user is logged in)
    $email = $_SESSION['email'];

    // Insert the product into the 'cart' table
    $sql = "INSERT INTO cart (Name, Price) VALUES ('$productName', '$productPrice')";
    if ($conn->query($sql) === TRUE) {
        echo "Product added to cart successfully.";
    } else {
        echo "Error adding product to cart: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Error: Invalid request.";
}
?>
