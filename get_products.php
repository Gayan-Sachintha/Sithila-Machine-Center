<?php
$con = mysqli_connect("localhost:3306", "root", "", "sahanapharmacy");
if (!$con) {
    die("DB Server Error: " . mysqli_connect_error());
}

$sql = "SELECT * FROM `product`";
$result = mysqli_query($con, $sql);

$products = array();
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

mysqli_close($con);

header('Content-Type: application/json');
echo json_encode($products);
?>
