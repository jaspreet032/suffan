<?php
// Database connection
$con = mysqli_connect('localhost', 'root', '', 'suffan');

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Initialize $nutritional_info array
$nutritional_info = array();
// Check if 'id' is set in the request and not empty
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
    $id = mysqli_real_escape_string($con, $_REQUEST['id']);

    $q = "SELECT * FROM `product` WHERE id = '$id'";
    $r = mysqli_query($con, $q);
    $y = mysqli_fetch_array($r); // Fetch data from the database

    if ($y !== null) { // Check if $y is not null
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
    } else {
        // Handle the case where 'id' is not found in the database
        echo "ID not found in the database.";
        exit();
    }
} else {
    // Handle the case where 'id' is not set or empty
    echo "ID is not provided or empty.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // Function to generate barcode with item details
    function generateBarcode($product, $d, $i, $us, $in, $nutritional_info, $con) {
        echo "<div>";
        // Output your barcode and item details here
        // ...
        echo "</div>";

        // Insert data into the database after printing the barcode
        $stmt = $con->prepare("INSERT INTO `label` (`product`, `pid`, `rate`, `useby`, `ingredients`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $product, $d, $i, $us, $in);
        if ($stmt->execute()) {
            echo "<script>alert('Data inserted successfully.')</script>";
        } else {
            echo "<script>alert('Failed to insert data.')</script>";
        }
        $stmt->close();
    }

    // Retrieve form data if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $product = $_POST['product'] ?? '';
        $d = $_POST['pid'] ?? '';
        $i = $_POST['rate'] ?? '';
        $us = $_POST['useby'] ?? '';
        $in = $_POST['ingredients'] ?? '';
        $print_qty = $_POST['print_qty'] ?? 0;

        // Generate individual pages for each barcode
        for ($j = 1; $j <= $print_qty; $j++) {
            generateBarcode($product, $d, $i, $us, $in, $nutritional_info, $con);
            // Add page break after each barcode
            if ($j < $print_qty) {
                echo "<div style='page-break-after: always;'></div>";
            }
        }
    }
    ?>
</body>
</html>
