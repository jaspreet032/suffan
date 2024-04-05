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
    function generateBarcode($product, $d, $i, $us, $in, $con,$energy,$kj,$fat,$saturate,$carbohydrates,$sugars,$protein,$salt,$fiber) {
        echo "<div style='margin-left: 5%;'>";
        echo "<table cellpadding='3' style='border-collapse: collapse; width: 50%;'>";
        echo "<tr> <td><b>$product</b></td></tr>";
        echo "<tr><td colspan='2'><b>Ingredients:</b>$in</td></tr>";
        echo "<tr><td colspan='5'>" . bar128(stripcslashes($d)) . "</td></tr>";
        echo "<tr><td style='width: 50%;'><b>Code:</b> $i</td><td style='width: 50%;'><b>Use By:</b> $us</td></tr>";

       
            echo "<tr><td><b>Nutritional Information:Energy (kcal):</b> $energy</td>
            <td><b>Energy (kj):</b> {$kj}</td></tr>";
            echo "<tr><td><b>Fat:</b> {$fat}</td>
            <td><b>Saturates:</b> {$saturate}</td></tr>";
            echo "<tr><td><b>Carbohydrates:</b> {$carbohydrates}</td>
            <td><b>Sugars:</b> {$sugars}</td></tr>";
            echo "<tr><td><b>Protein:</b> {$protein}</td>
            <td><b>Salt:</b> {$salt}</td></tr>";
            echo "<tr><td colspan='2'><b>Fiber:</b> {$fiber}</td></tr>";
        
        echo "</table>";
        
        echo "</div>";

        // Insert data into the database after printing the barcode
        $q = "INSERT INTO `label` (`product`, `pid`, `rate`, `useby`, `ingredients`) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $q);
        mysqli_stmt_bind_param($stmt, "sssss", $product, $d, $i, $us, $in);
        $r = mysqli_stmt_execute($stmt);
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
    $con = mysqli_connect('localhost', 'root', '', 'suffan'); 
  $q = "SELECT * FROM `product` where product='$product'";
    $r = mysqli_query($con, $q);
    // $y = mysqli_fetch_array($r);
    while($y=mysqli_fetch_array($r))
{
    // $id=$y['id'];
    $energy =$y['energy'];
    $kj =$y['kj'];
    $fat =$y['fat'];
    $saturates=$y['Saturates'];
    $carbohydrates=$y['carbohydrates'];
    $sugar=$y['sugars'];
    $protein=$y['protein'];
    $salt=$y['salt'];
    $fiber=$y['fiber'];
    $energy =$y['energy'];
   $print_qty = $_POST['print_qty'] ?? 0;
}
    // Generate individual pages for each barcode
    for ($j = 1; $j <= $print_qty; $j++) {
        generateBarcode($product, $d, $i, $us, $in,$con,$energy,$kj,$fat,$saturates,$carbohydrates,$sugar,$protein,$salt,$fiber);
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
