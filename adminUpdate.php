<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            background-color: #f1f1f1;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        .container input[type="text"],
        .container input[type="file"],
        .container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .container textarea {
            height: 150px;
            resize: vertical;
        }

        .container .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .container .checkbox-container label {
            margin-left: 10px;
        }

        .container .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .container .button-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .container .button-container button.edit-button {
            background-color: #4CAF50;
        }

        .container .button-container button.edit-button:hover {
            background-color: #45a049;
        }

        .container .button-container button.delete-button {
            background-color: #f44336;
        }

        .container .button-container button.delete-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["txtuname"])) {
        header("location:account.php");
    }

    $con = mysqli_connect("localhost:3306", "root", "", "sahanapharmacy");
    if (!$con) {
        die("DB Server Error");
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM `product` WHERE `id` = '$id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found!";
        exit;
    }
    mysqli_close($con);
    ?>

    <div class="container">
        <h1>Edit Product</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="txtProductName">Product Name</label>
            <input type="text" placeholder="Enter Product Name" name="txtProductName" id="txtProductName" value="<?php echo $row["Name"]; ?>" required>

            <label for="imagefol">File</label>
            <input type="file" name="imagefol" id="imagefol">

            <label for="txtPrice">Price</label>
            <input type="text" placeholder="Enter Price" name="txtPrice" id="txtPrice" value="<?php echo $row["Price"]; ?>" required>

            <div class="checkbox-container">
                <input type="checkbox" name="chkPublish" id="chkPublish" <?php if ($row["Post"] == 1) {
                    echo "checked";
                } ?>>
                <label for="chkPublish">Publish this</label>
            </div>

            <div class="button-container">
                <button type="submit" class="edit-button" name="btnSubmit" id="btnSubmit">Update</button>
                <button type="button" class="delete-button" onclick="window.location.href='admin.php'">Cancel</button>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST["btnSubmit"])) {
        $name = $_POST["txtProductName"];
        $price = $_POST["txtPrice"];
        $status = isset($_POST["chkPublish"]) ? 1 : 0;

        $con = mysqli_connect("localhost:3306", "root", "", "sahanapharmacy");
        if (!$con) {
            die("We are facing a technical issue");
        }

        $id = $_GET["id"];
        $image = $_FILES["imagefol"]["name"];

        if ($image != '') {
            $image = "uploads/" . basename($image);
            move_uploaded_file($_FILES["imagefol"]["tmp_name"], $image);
            $sql = "UPDATE `product` SET `Name`='$name',`Price`='$price',`Path`='$image',`Post`='$status' WHERE `id`='$id'";
        } else {
            $sql = "UPDATE `product` SET `Name`='$name',`Price`='$price',`Post`='$status' WHERE `id`='$id'";
        }

        if (mysqli_query($con, $sql)) {
            echo "<p>File Updated Successfully</p>";
        } else {
            echo "<p>Please select the file again!</p>";
        }

        header('Location: admin.php');
    }
    ?>
</body>

</html>
