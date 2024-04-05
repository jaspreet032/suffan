<?php
include 'barcode128.php';

function generateBarcode($product, $d, $i, $us, $in, $con, $energy, $kj, $fat, $saturate, $carbohydrates, $sugars, $protein, $salt, $fiber) {
    // echo "<div style='margin-left: 5%;'>";
    // echo "<table cellpadding='3' style='border-collapse: collapse; width: 50%;'>";
    // echo "<tr> <td><b>$product</b></td></tr>";
    // echo "<tr><td colspan='2'><b>Ingredients:</b>$in</td></tr>";
 echo "<tr><td colspan='5'>" . bar128(stripcslashes($d)) . "</td></tr>";
    // echo "<tr><td style='width: 50%;'><b>Code:</b> $i</td><td style='width: 50%;'><b>Use By:</b> $us</td></tr>";

    // echo "<tr><td><b>Nutritional Information<br>Energy (kcal):</b> $energy</td><td><b>Energy (kj):</b> {$kj}</td></tr>";
    // echo "<tr><td><b>Fat:</b> {$fat}</td><td><b>Saturates:</b> {$saturate}</td></tr>";
    // echo "<tr><td><b>Carbohydrates:</b> {$carbohydrates}</td><td><b>Sugars:</b> {$sugars}</td></tr>";
    // echo "<tr><td><b>Protein:</b> {$protein}</td> <td><b>Salt:</b> {$salt}</td></tr>";
    // echo "<tr><td colspan='2'><b>Fiber:</b> {$fiber}</td></tr>";
    
    echo "</table>";
    echo "</div>";
}

$con = mysqli_connect('localhost', 'root', '', 'suffan');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$product = $_POST['product'] ?? '';
$d = $_POST['pid'] ?? '';
$i = $_POST['rate'] ?? '';
$us = $_POST['useby'] ?? '';
$in = $_POST['ingredients'] ?? '';

// Escape user inputs to prevent SQL injection
$product = mysqli_real_escape_string($con, $product);

$q = "SELECT * FROM `product` where pname='$product'";
$r = mysqli_query($con, $q);
if (!$r) {
    die("Query failed: " . mysqli_error($con));
}

while ($y = mysqli_fetch_array($r)) {
    $energy = $y['energy'];
    $kj = $y['kj'];
    $fat = $y['fat'];
    $saturates = $y['Saturates'];
    $carbohydrates = $y['carbohydrates'];
    $sugar = $y['sugars'];
    $protein = $y['protein'];
    $salt = $y['salt'];
    $fiber = $y['fiber'];
    $print_qty = $_POST['print_qty'] ?? 0;
}

// Generate individual pages for each barcode
for ($j = 1; $j <= $print_qty; $j++) {
    generateBarcode($product, $d, $i, $us, $in, $con, $energy, $kj, $fat, $saturates, $carbohydrates, $sugar, $protein, $salt, $fiber);
    // Add page break after each barcode
    if ($j < $print_qty) {
        echo "<div style='page-break-after: always;'></div>";
    }
}

// Insert data into the database after printing the barcodes
$q = "INSERT INTO `label` (`product`, `pid`, `rate`, `useby`, `ingredients`) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $q);
mysqli_stmt_bind_param($stmt, "sssss", $product, $d, $i, $us, $in);

$r = mysqli_stmt_execute($stmt);
if ($r) {
    echo "<script>alert('Data inserted successfully.')</script>";
} else {
    echo "<script>alert('Failed to insert data.')</script>";
}

mysqli_close($con);
?>
<script>
// Automatically trigger printing when the page loads
window.onload = function() {
    window.print();
};
</script> 
