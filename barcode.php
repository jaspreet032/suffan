<!-- <?php

$con = mysqli_connect('localhost', 'root', '', 'suffan'); 

$q = "select * from `product`";
$r = mysqli_query($con, $q);
$y = mysqli_fetch_array($r); // Fetch data from the database

$nutritional_info = array(
    'energy' => $y['energy'],
    'kj' => $y['kj'],
    'fat' => $y['fat'],
    'Saturates' => $y['Saturates'],
    'carbohydrates' => $y['carbohydrates'],
    'sugars' => $y['sugars'],
    'protein' => $y['protein'],
    'salt' => $y['salt'],
    'fiber' => $y['fiber']
);
?>
<?php
include 'barcode128.php';

// Function to generate barcode with item details
function generateBarcode($product, $d, $i, $us, $in, $nutritional_info) {
    echo "<div style='margin-left: 5%;'>";
    echo "<table cellpadding='3' style='border-collapse: collapse; width: 50%;'>";
    echo "<tr> <td><b>$product</b></td></tr>";
    echo "<tr><td colspan='2'><b>Ingredients:</b>$in</td></tr>";
    echo "<tr><td colspan='5'>" . bar128(stripcslashes($d)) . "</td></tr>";
    echo "<tr><td style='width: 50%;'><b>Code:</b> $i</td><td style='width: 50%;'><b>Use By:</b> $us</td></tr>";
    
    if (isset($nutritional_info)) {
        echo "<tr><td><b>Nutritional Information:Energy (kcal):</b> {$nutritional_info['energy']}</td><td><b>Energy (kj):</b> {$nutritional_info['kj']}</td></tr>";
        echo "<tr><td><b>Fat:</b> {$nutritional_info['fat']}</td><td><b>Saturates:</b> {$nutritional_info['Saturates']}</td></tr>";
        echo "<tr><td><b>Carbohydrates:</b> {$nutritional_info['carbohydrates']}</td><td><b>Sugars:</b> {$nutritional_info['sugars']}</td></tr>";
        echo "<tr><td><b>Protein:</b> {$nutritional_info['protein']}</td><td><b>Salt:</b> {$nutritional_info['salt']}</td></tr>";
        echo "<tr><td colspan='2'><b>Fiber:</b> {$nutritional_info['fiber']}</td></tr>";
    }
    echo "</table>";
    echo "</div>";
}

$product = $_POST['product'];
$d = $_POST['pid'];
$i = $_POST['rate'];
$us = $_POST['useby'];
$in = $_POST['ingredients'];

$print_qty = $_POST['print_qty'];
// Generate individual pages for each barcode
for ($j = 1; $j <= $print_qty; $j++) {
    generateBarcode($product, $d, $i, $us, $in, $nutritional_info);
    // Add page break after each barcode
    if ($j < $print_qty) {
        echo "<div style='page-break-after: always;'></div>";
    }
}
?>
<script>
// Automatically trigger printing when the page loads
window.onload = function() {
    window.print();
};
</script>

</body>
</html> -->
