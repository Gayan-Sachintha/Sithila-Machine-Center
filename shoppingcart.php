<?php
session_start();
if (!isset($_SESSION["txtuname"])) {
    header("location: account.php");
    exit;
}

$con = mysqli_connect("localhost", "root", "", "sahanapharmacy");

if (!$con) {
    die("DB Server Error: " . mysqli_connect_error());
}

$email = $_SESSION['txtuname'];
$sql = "SELECT * FROM cart WHERE email = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$results = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page - SAHANA PHARMACY</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="home.php"><img src="images/Blue White Modern Health Medical Center Logo (1).png" alt="" width="120px"></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="account.php">Account</a></li>
                </ul>
            </nav>
            <a href="shoppingcart.php"><img src="images/cart.png" alt="" width="30px" height="30px"></a>
            <img src="images/menuicon.png" alt="" class="menu-icon" onclick="menutoggle()">
            <a href="admin.php"><img src="images/adminicon.png" alt="" width="30px" height="30px"></a>
        </div>
    </div>

    <div class="small-container cart-page">
        <table id="cart-table">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($results)) { ?>
                <tr>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Price']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <div class="total-price">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td id="subtotal">Rs.0.00</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>Rs.100.00</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td id="total">Rs.0.00</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Download Our App</h3>
                    <p>Download App for Android and iOS mobile phones.</p>
                    <div class="app-logo">
                        <img src="images/playstore.png" alt="">
                        <img src="images/appstore.png" alt="">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="images/SAHANA Medical Center Logo.png" alt="" width="120px">
                    <p>Our purpose is to bring the pleasure and benefits of healthcare to the many.</p>
                </div>
                <div class="footer-col-3">
                    <h3>Useful Links</h3>
                    <ul>
                        <li>Coupons</li>
                        <li>Blog Post</li>
                        <li>Return Policy</li>
                        <li>Join Affiliate</li>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <h3>Follow Us On</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Instagram</li>
                        <li>Twitter</li>
                        <li>Youtube</li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="copyright">
                &copy; 2023 - SAHANA PHARMACY
            </p>
        </div>
    </div>

    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";

        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px";
            } else {
                MenuItems.style.maxHeight = "0px";
            }
        }
    </script>
</body>
</html>
