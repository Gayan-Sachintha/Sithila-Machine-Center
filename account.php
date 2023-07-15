<?php session_start() ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Account Page-SAHANA PHARMACY</title>
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

    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="images/background1.png" alt="" width="100%">
                </div>
                <div class="col-2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span onclick="login()">Login</span>
                            <span onclick="register()">Register</span>
                            <hr id="Indicator">
                        </div>


                <form id="LoginForm" action="account.php" method="POST">

                            <input type="text" placeholder="Enter Username" name="txtuname" id="txtuname" required>
                            <input type="password" type="password" placeholder="Enter Password" name="txtpassword" id="txtpassword" required>
                            <button type="submit" value="login" name="btnsubmit" id="subbtn">Login</button><br>
                            <a href="RegForm">Forget password</a>
                        </form>

                        <?php
				if(isset($_POST["btnsubmit"]))
				{
				$username = $_POST["txtuname"];
				$password = $_POST["txtpassword"]; //Read the values from textfields
				$valid = false;
					
				$con = mysqli_connect("localhost:3306","root","","sahanapharmacy");
					
				if(!$con) //check db connection
				{
					die("DB Seaver Error");
				}
						$sql = "SELECT * FROM `user` WHERE `Email` = '".$username."' and `Password` = '".$password."' and `userType`= 'customer'"; 
					
						$result = mysqli_query($con,$sql); // execute quary for customer
					
							
			   if (mysqli_num_rows($result) > 0)
				{
					$_SESSION["txtuname"] = $username;
					 header('Location:home.php');
                    // echo "successfull";
				}
				else
				{
					$sql = "SELECT * FROM `user` WHERE `Email` = '".$username."' and `Password` = '".$password."' and `userType`= 'admin'"; 
					
					$result = mysqli_query($con,$sql); //execute quary for Admin
					if (mysqli_num_rows($result) > 0)
					{
						$_SESSION["txtuname"] = $username;
						header('Location: admin.php');
					}
					else{
						echo "Please enter correct username and password";
					}
					
				}
				}	    
				?>

                        <form id="RegForm" action="account.php" method="POST">

                        <p>Full Name:</p>
            <input type="text" name="txtFullName" placeholder="Full Name" id="txtFullName" required>
            <p>Contact Number:</p>
            <input type="text" name="txtnum" placeholder="Contact Number" id="txtnum" required>
            <p>Email:</p>
            <input type="email" name="txtEmail" placeholder="Email" id="txtEmail" required>
            <p>Password:</p>
            <input type="password" name="txtPassword" placeholder="Password" id="txtPassword" required>

            <button type="submit" class="button1" name="btnSubmit" id="btnSubmit">Signup</button>
                        </form>

                <?php
                        if (isset($_POST["btnSubmit"])) {
                            $fullname = $_POST["txtFullName"];
                            $contact = $_POST["txtnum"];
                            $email = $_POST["txtEmail"];
                            $password = $_POST["txtPassword"];
                            $userType = "customer";
                            $con = mysqli_connect("localhost:3306", "root", "", "sahanapharmacy");

                            if (!$con) {
                                die("Cannot connect to the DB Server");
                            }

                            $sql = "INSERT INTO `user` (`Fullname`, `Cnumber`, `Email`, `Password`, `userType`) VALUES ('$fullname', '$contact', '$email', '$password', '$userType');";

                            if (mysqli_query($con, $sql)) {
                                header('Location: account.php');
                            }
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>





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
    <script>
        var LoginForm = document.getElementById("LoginForm");
        var RegForm = document.getElementById("RegForm");
        var Indicator = document.getElementById("Indicator");
		var contactform = document.getElementById("contactform");

        function register(){
            RegForm.style.transform = "translateX(0px)";
            LoginForm.style.transform = "translateX(0px)";
            Indicator.style.transform = "translateX(100px)";

        }
        function login(){
            RegForm.style.transform = "translateX(300px)";
            LoginForm.style.transform = "translateX(300px)";
            Indicator.style.transform = "translateX(0px)";
        }

    </script>
</body>

</html>