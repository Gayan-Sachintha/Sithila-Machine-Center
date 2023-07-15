<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - SAHANA PHARMACY</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .admin-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 20px;
            align-items: start; /* Added property */
            margin-top: 20px;
        }
        
        .admin-content .col-4 {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }
        
        .admin-content .col-4 img {
            width: 100%;
            height: auto;
        }
        
        .admin-content .col-4 h4 {
            font-size: 18px;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        
        .admin-content .col-4 p {
            font-size: 16px;
            color: #888;
            margin-bottom: 10px;
        }
        
        .admin-content .col-4 a.btn {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            margin-right: 5px;
        }
        
        .admin-content .col-4 a.btn:hover {
            background-color: #45a049;
        }

        .admin-content .col-4 .delete-btn {
            display: inline-block;
            background-color: #f44336;
            color: #fff;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        
        .admin-content .col-4 .delete-btn:hover {
            background-color: #d32f2f;
        }
    </style>
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
        <a href="shoppingcart.php"><img src="images/cart.png" alt="" width="30px" height="30px"></a>
        <img src="images/menuicon.png" alt="" class="menu-icon" onclick="menutoggle()">
        <a href="admin.php"><img src="images/adminicon.png" alt="" width="30px" height="30px"></a>
    </div>

    <section id="admin">
        <h2>Admin Page</h2>
        <div class="admin-menu">
            <ul>
                <li><a href="adminAdd.php" style="display: flex; justify-content: center;"><button type="submit" name="btnsubmit" id="subbtn">Add Store</button></a></li>
            </ul>
        </div>
        <div class="admin-content" id="admin-products">
            <!-- Product container -->
        </div>
    </section>

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Download Our App</h3>
                    <p>Download App for Android and iOS mobile phone.</p>
                    <div class="app-logo">
                        <img src="images/playstore.png" alt="">
                        <img src="images/appstore.png" alt="">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="images/SAHANA Medical Center Logo.png" alt="" width="120px">
                    <p>Our Purpose is to make the pleasure and benefits of health care to the many.</p>
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
            <p class="footer-text">© 2023 - SAHANA PHARMACY</p>
        </div>
    </div>

    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";
        function menutoggle(){
            if(MenuItems.style.maxHeight == "0px"){
                MenuItems.style.maxHeight = "200px";
            } else {
                MenuItems.style.maxHeight = "0px";
            }
        }

        function addProductToAdmin(name, imageSrc, price, description, id) {
            var productContainer = document.createElement('div');
            productContainer.classList.add('col-4');

            var image = document.createElement('img');
            image.src = imageSrc;
            productContainer.appendChild(image);

            var productName = document.createElement('h4');
            productName.textContent = name;
            productContainer.appendChild(productName);

            var productPrice = document.createElement('p');
            productPrice.textContent = 'Rs. ' + price;
            productContainer.appendChild(productPrice);

            if (description !== '') {
                var productDescription = document.createElement('h4');
                productDescription.textContent = description;
                productContainer.appendChild(productDescription);
            }

            var editButton = document.createElement('a');
            editButton.href = 'adminUpdate.php?id=' + id;
            editButton.textContent = 'EDIT';
            editButton.classList.add('btn');
            productContainer.appendChild(editButton);

            var deleteButton = document.createElement('a');
            deleteButton.href = 'deleteItem.php?id=' + id;
            deleteButton.textContent = 'DELETE';
            deleteButton.classList.add('delete-btn');
            productContainer.appendChild(deleteButton);

            var container = document.getElementById('admin-products');
            container.appendChild(productContainer);
        }

        // Fetch products from the database and display them
        fetch('get_products.php')
            .then(response => response.json())
            .then(products => {
                products.forEach(product => {
                    addProductToAdmin(
                        product.Name,
                        product.Path,
                        product.Price,
                        '',
                        product.id
                    );
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    </script>
</body>
</html>
