<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - SAHANA PHARMACY</title>
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
    <div class="small-container">
        <div class="row row-2">
            <h2>All Products</h2>
            <select>
                <option>Default Sorting</option>
                <option>Sort by price</option>
                <option>Sort by sale</option>
            </select>
        </div>
        <div class="row" id="product-container">
            <!-- Product container -->
        </div>
    </div>
    <div class="page-btn">
        <span>1</span>
        <span>2</span>
        <span>3</span>
        <span>4</span>
        <span>&#8594;</span>
    </div>
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
                    <p>Our Purpose is to bring the pleasure and benefits of healthcare to many.</p>
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

        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px";
            } else {
                MenuItems.style.maxHeight = "0px";
            }
        }

        // Fetch products from the server and display them
        fetch('get_products.php')
            .then(response => response.json())
            .then(products => {
                var productContainer = document.getElementById('product-container');

                products.forEach(product => {
                    var colDiv = document.createElement('div');
                    colDiv.classList.add('col-4');

                    var image = document.createElement('img');
                    image.src = product.Path;
                    colDiv.appendChild(image);

                    var name = document.createElement('h4');
                    name.textContent = product.Name;
                    colDiv.appendChild(name);

                    var price = document.createElement('p');
                    price.textContent = 'Rs. ' + product.Price;
                    colDiv.appendChild(price);

                    var quantityInput = document.createElement('input');
                    quantityInput.type = 'number';
                    quantityInput.value = '1';
                    quantityInput.id = 'quantity-input'; // Added ID to the quantity input
                    colDiv.appendChild(quantityInput);

                    var addToCartBtn = document.createElement('a');
                    addToCartBtn.href = '#';
                    addToCartBtn.textContent = 'Add to Cart';
                    addToCartBtn.classList.add('btn');
                    addToCartBtn.addEventListener('click', function() {
                        addToCart(product.Name, product.Price);
                    });
                    colDiv.appendChild(addToCartBtn);

                    productContainer.appendChild(colDiv);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });

        function addToCart(productName, price) {
            var quantityInput = document.getElementById('quantity-input');
            var quantity = parseInt(quantityInput.value);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_to_cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                    } else {
                        console.error("Error adding product to cart: " + xhr.status);
                    }
                }
            };
            xhr.send("productName=" + encodeURIComponent(productName) + "&productPrice=" + encodeURIComponent(price) + "&quantity=" + encodeURIComponent(quantity));
        }
    </script>
</body>
</html>