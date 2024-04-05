<?php
// Database connection
$con = mysqli_connect('localhost', 'root', '', 'suffan');
if (mysqli_connect_errno()) {
    echo json_encode(array('error' => 'Failed to connect to MySQL: ' . mysqli_connect_error()));
    exit();
}

// Check if the barcode value is sent via POST
if (isset($_POST['barcode'])) {
    // Sanitize the input
    $barcode = mysqli_real_escape_string($con, $_POST['barcode']);

    // Query to fetch product information based on the barcode
    $query = "SELECT * FROM `label` WHERE `product` = '$barcode'";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Fetch product information
        $row = mysqli_fetch_assoc($result);
        // Prepare the data to be sent back as JSON
        $product_info = array(
            'product' => $row['product'],
            'vendor' => $row['vendor'],
            'labels' => $row['labels'],
            'status' => $row['status']
        );

        // Send the product information as JSON response
        echo json_encode($product_info);
        
        session_start();


    } else {
        // If query fails
        echo json_encode(array('error' => 'Failed to fetch product information'));
    }
} else {
    // If barcode value is not sent
    echo json_encode(array('error' => 'Barcode value not received'));
}

// Close database connection
mysqli_close($con);
?>
