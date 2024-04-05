<?php
include 'barcode128.php';

// Function to generate barcode and return HTML content
function generateBarcodeHTML($product, $d, $i, $us, $in, $con, $energy, $kj, $fat, $saturate, $carbohydrates, $sugars, $protein, $salt, $fiber) {
    // $html = "<div style='margin-left: 5%;'>";
    // $html .= "<table cellpadding='3' style='border-collapse: collapse; width: 100%;'>";
    // $html .= "<tr> <td><b>$product</b></td></tr>";
    // $html .= "<tr><td colspan='2'><b>Ingredients:</b>$in</td></tr>";
    $html .= "<tr><td colspan='5'>" . bar128(stripcslashes(($product .$d. $i))) . "</td></tr>";
    // $html .= "<tr><td style='width: 50%;'><b>Code:</b> $i</td><td style='width: 50%;'><b>Use By:</b> $us</td></tr>";

    // $html .= "<tr><td><b>Nutritional Information<br>Energy (kcal):</b> $energy</td><td><b>Energy (kj):</b> {$kj}</td></tr>";
    // $html .= "<tr><td><b>Fat:</b> {$fat}</td><td><b>Saturates:</b> {$saturate}</td></tr>";
    // $html .= "<tr><td><b>Carbohydrates:</b> {$carbohydrates}</td><td><b>Sugars:</b> {$sugars}</td></tr>";
    // $html .= "<tr><td><b>Protein:</b> {$protein}</td> <td><b>Salt:</b> {$salt}</td></tr>";
    // $html .= "<tr><td colspan='2'><b>Fiber:</b> {$fiber}</td></tr>";
    
    $html .= "</table>";
    $html .= "</div>";
    
    return $html;
}

// Establish database connection
$con = mysqli_connect('localhost', 'root', '', 'suffan');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from POST
$product = $_POST['product'] ?? '';
$d = $_POST['pid'] ?? '';
$i = $_POST['rate'] ?? '';
$us = $_POST['useby'] ?? '';
$in = $_POST['ingredients'] ?? '';
$print_qty = $_POST['print_qty'] ?? 0;

// Escape user inputs to prevent SQL injection
$product = mysqli_real_escape_string($con, $product);

// Fetch nutritional information from database
$q = "SELECT * FROM `product` WHERE pname='$product'";
$r = mysqli_query($con, $q);
if (!$r) {
    die("Query failed: " . mysqli_error($con));
}

// Variable to store generated HTML content
$generatedHTML = '';

// Generate individual pages for each barcode
for ($j = 1; $j <= $print_qty; $j++) {
    $generatedHTML .= generateBarcodeHTML($product, $d, $i, $us, $in, $con, $energy, $kj, $fat, $saturates, $carbohydrates, $sugar, $protein, $salt, $fiber);
    // Add page break after each barcode
    if ($j < $print_qty) {
        $generatedHTML .= "<div style='page-break-after: always;'></div>";
    }
}

// Display generated barcodes within a div
echo "<div id='generatedBarcodes'>$generatedHTML</div>";

// Insert data into the database after printing the barcodes
// $q = "INSERT INTO `label` (`product`, `pid`, `rate`, `useby`, `ingredients`) VALUES (?, ?, ?, ?, ?)";
// $stmt = mysqli_prepare($con, $q);
// mysqli_stmt_bind_param($stmt, "sssss", $product, $d, $i, $us, $in);

// $r = mysqli_stmt_execute($stmt);
// if ($r) {
//     echo "<script>alert('Data inserted successfully.')</script>";
// } else {
//     echo "<script>alert('Failed to insert data.')</script>";
// }

// mysqli_close($con);
// ?>
// <script>
// // Automatically trigger printing when the page loads
// window.onload = function() {
//     window.print();
// };
// </script> 
