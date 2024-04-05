<?php
// get_product_info.php

// Database connection
$con = mysqli_connect('localhost', 'root', '', 'suffan');
if (mysqli_connect_errno()) {
    echo json_encode(['error' => 'Failed to connect to MySQL: ' . mysqli_connect_error()]);
    exit();
}

if(isset($_POST['barcode'])) {
    $barcode = $_POST['barcode'];
    
    // Fetch product information based on barcode
    $query = "SELECT * FROM `label` WHERE pid = '$barcode'";
    $result = mysqli_query($con, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Return product information as JSON response
        echo json_encode([
            'product' => $row['product'],
            'vendor' => $row['vendor'],
            'labels' => $row['labels'],
            'status' => $row['status']
        ]);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }
} else {
    echo json_encode(['error' => 'Barcode not provided']);
}

mysqli_close($con);
?>
