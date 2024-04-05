<!-- Barcode Selection Section -->
<div class="card mb-3">
    <div class="card-body">
        <div id="barcodeList" class="row row-cols-1 row-cols-md-4 g-4" style="font-size: 19px;">
            <?php
            include 'barcode128.php';
            // Database connection
            $con = mysqli_connect('localhost', 'root', '', 'suffan');
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }

            // Fetching barcode data from the database
            $query = "SELECT * FROM `label`";
            $result = mysqli_query($con, $query);

            // Loop through fetched barcodes
            while ($row = mysqli_fetch_array($result)) {
                // Display each barcode in a card
                echo '<div class="col">
                        <div class="card barcode-card">
                            <div class="card-body">
                                <div class="barcode" data-product="' .htmlspecialchars($row['product']) . '">' . bar128(stripcslashes($row['product'])) . '</div>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Script for AJAX request -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var barcodes = document.querySelectorAll('.barcode');
        barcodes.forEach(function(barcode) {
            barcode.addEventListener('click', function() {
                var productName = this.getAttribute('data-product');
                alert('Product Name: ' + productName);
                document.getElementById('selectedProduct').value = productName; // Update input field with product name
            });
        });
    });
</script>

<!-- Input field for the selected product -->

