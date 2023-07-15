<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page-SAHANA PHARMACY</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
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
        <a href="shoppingcart.php" ><img src="images/cart.png" alt="" width="30px" height="30px"></a>
        <img src="images/menuicon.png" alt="" class="menu-icon" onclick="menutoggle()">
        <a href="admin.php"><img src="images/adminicon.png" alt="" width="30px" height="30px"></a>
    </div>
            <section id="contact">
                <div class="contact-info">
                  <h2>Contact Us</h2>
                  <p>Use our contact form to reach us to communicate or visit our store in person:</p>
                  <p>27/1, Madeiyawa Road, Kegalle</p>
                </div>
                
                <div class="contact-form">
                  <h2>Send Us a Message</h2>
                  <form id="contact-form">
                    <div class="form-group">
                      <label for="name">Name:</label>
                      <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                      <label for="message">Message:</label>
                      <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit">Send</button>
                  </form>
                </div>
              </section>
<!--------footer------------>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Download Our App</h3>
                    <p>Download App for Android and ios mobile phone.</p>
                    <div class="app-logo">
                        <img src="images/playstore.png" alt="">
                        <img src="images/appstore.png" alt="">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="images/SAHANA Medical Center Logo.png" alt="" width="120px">
                    <p>Our Purpose is to make the pleasure and benifits of <br> health care to the many.</p>
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
            <p class="copyright">Copyright 23' - SAHANA PHARMACY</p>
        </div>
    </div>
    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";
        function menutoggle(){
            if(MenuItems.style.maxHeight == "0px")
            {
                MenuItems.style.maxHeight = "200px";
            }
            else{
                MenuItems.style.maxHeight = "0px";
            }
        }
    </script>
</body>
</html>