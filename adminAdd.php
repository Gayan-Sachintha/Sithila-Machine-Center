<?php
session_start();
if (!isset($_SESSION["txtuname"])) {
    header("location:account.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddStore</title>
    <link rel="stylesheet" type="text/css" href="login.css" />
</head>
<body style="background-color: #f2f2f2; font-family: Arial, sans-serif;">
    <form action="" method="post" enctype="multipart/form-data"
          style="width: 400px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 5px;">
        <h1 style="text-align: center;">Add Product</h1>
        <hr>
        <div style="margin-bottom: 20px;">
            <label for="pName" style="font-weight: bold;">Product Name</label>
            <input type="text" placeholder="Enter Product Name" name="txtProductName" id="txtProductName" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="image" style="font-weight: bold;">Image</label>
            <input type="file" name="imagefol" id="imagefol" required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="price" style="font-weight: bold;">Price</label>
            <input type="text" placeholder="Enter Price" name="txtPrice" id="txtPrice" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="chkPublish" style="font-weight: bold;">Publish</label>
            <input type="checkbox" name="chkPublish" id="chkPublish">
        </div>

        <div style="text-align: center;">
            <button type="submit" class="button" name="btnSubmit" id="btnSubmit" style="background-color: #4CAF50; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Add Product</button>
            <button type="button" class="button" style="background-color: #f44336; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Cancel</button>
        </div>
    </form>

    <?php
    if (isset($_POST["btnSubmit"])) {
        $name = $_POST["txtProductName"];
        $image = "uploads/" . basename($_FILES["imagefol"]["name"]);
        move_uploaded_file($_FILES["imagefol"]["tmp_name"], $image);
        $price = $_POST["txtPrice"];

        if (isset($_POST["chkPublish"])) {
            $status = 1;
        } else {
            $status = 0;
        }

        $con = mysqli_connect("localhost:3306", "root", "", "sahanapharmacy");
        if (!$con) {
            die("we are facing a technical issue");
        }

        $sql = "INSERT INTO `product`(`id`, `Email`, `Name`, `Price`, `Path`, `Post`) VALUES (NUll,'" . $_SESSION["txtuname"] . "','" . $name . "','" . $price . "','" . $image . "','" . $status . "');";

        if (mysqli_query($con, $sql)) {
            echo "file uploaded Successfully";

            // Retrieve existing products from localStorage
            $existingProducts = json_decode($_COOKIE['adminProducts'], true);

            // Create a new product object
            $newProduct = array(
                'name' => $name,
                'image' => $image,
                'price' => $price,
                'description' => ''
            );

            // Add the new product to the existing products array
            $existingProducts[] = $newProduct;

            // Store the updated products array in localStorage
            setcookie('adminProducts', json_encode($existingProducts), time() + (86400 * 30), '/');

            header('Location:admin.php');
        } else {
            echo "please select the file again !!!!";
        }
    }
    ?>
</body>
</html>
