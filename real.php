<?php
$con = mysqli_connect('localhost', 'root', '', 'suffan');
$nutritional_info = array();

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $q = "SELECT * FROM `product` where id='$id'";
    $r = mysqli_query($con, $q);

  
    if($r) {
        $y = mysqli_fetch_array($r); 

       
        if($y) {
            $nutritional_info = array(
                'id' => $y['id'], 
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
        }
    } else {
     
        echo "Error: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php
    include 'barcode128.php';

    // Function to generate barcode with item details
    function generateBarcode($product, $d, $i, $us, $in, $nutritional_info, $con) {
        global $nutritional_info; // Use the global variable $nutritional_info

        echo "<div style='margin-left: 5%;'>";
        echo "<table cellpadding='3' style='border-collapse: collapse; width: 50%;'>";
        echo "<tr> <td><b>$product</b></td></tr>";
        echo "<tr><td colspan='2'><b>Ingredients:</b>$in</td></tr>";
        echo "<tr><td colspan='5'>" . bar128(stripcslashes($d)) . "</td></tr>";
        echo "<tr><td style='width: 50%;'><b>Code:</b> $i</td><td style='width: 50%;'><b>Use By:</b> $us</td></tr>";

        // Check if 'id' key exists in $nutritional_info array before accessing it
        if (isset($nutritional_info['id'])) {
            echo "<tr><td><b>ID:</b> {$nutritional_info['id']}</td></tr>";
        }

        if (!empty($nutritional_info)) { // Check if $nutritional_info is not empty before accessing it
            echo "<tr><td><b>Nutritional Information:Energy (kcal):</b> {$nutritional_info['energy']}</td><td><b>Energy (kj):</b> {$nutritional_info['kj']}</td></tr>";
            echo "<tr><td><b>Fat:</b> {$nutritional_info['fat']}</td><td><b>Saturates:</b> {$nutritional_info['Saturates']}</td></tr>";
            echo "<tr><td><b>Carbohydrates:</b> {$nutritional_info['carbohydrates']}</td><td><b>Sugars:</b> {$nutritional_info['sugars']}</td></tr>";
            echo "<tr><td><b>Protein:</b> {$nutritional_info['protein']}</td><td><b>Salt:</b> {$nutritional_info['salt']}</td></tr>";
            echo "<tr><td colspan='2'><b>Fiber:</b> {$nutritional_info['fiber']}</td></tr>";
        }
        echo "</table>";
        echo "</div>";

        // Insert data into the database after printing the barcode
        $q = "INSERT INTO `label` (`product`, `pid`, `rate`, `useby`, `ingredients`) VALUES ('$product', '$d', '$i', '$us', '$in')";
        $r = mysqli_query($con, $q);
        if ($r) {
            echo "<script>alert('Data inserted successfully.')</script>";
        } else {
            echo "<script>alert('Failed to insert data.')</script>";
        }
    }

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
    ?>
    <script>
    // Automatically trigger printing when the page loads
    window.onload = function() {
        window.print();
    };
    </script>
</body>
</html>
