 <?php
 include 'navbar.php';
 ?>

<?php
include 'new.php';

?>


   

<!-- Begin Page Content -->
<div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow mb-4">
            <div class="card-body">
            <form method="post" action="inserrt.php" enctype="multipart/form-data">
          <!-- Barcode Selection Section -->
          <div class="form-group mb-3">
          <label for="selectedProduct" class="form-label">Selected Product</label>
<input type="text" class="form-control" id="selectedProduct" name="product" >
                    </div>


<div class="form-group mb-3">
        <label for="vendor">Vendor</label>
        <select name="vendor" class="form-control">
        <option value="please select">Please select</option>
        </div>                                     
            <?php
            $con = mysqli_connect('localhost', 'root', '', 'suffan');
            $q = "select * from `supplier`";
            $r = mysqli_query($con, $q);    
            while ($y = mysqli_fetch_array($r)) {
                    echo '<option value="' . $y['name'] . '">' . $y['name'] . '</option>';
                    
            }
                                                ?>
        </select>
    </div><div>
                                      



<div class="form-group">
     <label for="labels" class="form-label">Number of Labels</label>
        <input type="text" class="form-control" id="labels" name="lables" required>
        </div>
        <div class="form-group">
         <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select">
             <option value="please select">Please select</option>
                <option value="pending">Pending</option>
            <option value="delivered">Delivered</option>
            <option value="shipped">Shipped</option>
             <option value="cancel">Cancel</option>
           
            <option value="not attempted">not attempted</option>
            </select>
     </div>
                                       


<button type="submit" class="form-submit d-block mx-auto btn-primary btn-lg btn-lg btn-block" name="submit">submit</button>
</form>
        
</div></div>
</div>
   
            <!-- End of Main Content -->

            <!-- Footer -->
          <?php
          include 'footer.php';
          ?>
          
<script>
    // JavaScript to update input box with selected product
    document.getElementById('productSelect').addEventListener('change', function() {
        var selectedProduct = this.value;
        document.getElementById('selectedProduct').value = selectedProduct;
    });
</script>
<script>
    // JavaScript to update input box with selected product
    document.getElementById('productSelect').addEventListener('change', function() {
        var selectedProduct = this.value;
        document.getElementById('selectedProduct').value = selectedProduct;
    });
</script>

<!-- <script>
    // JavaScript to update input box with barcode information
    document.getElementById('barcode').addEventListener('click', function() {
        var barcodeValue = this.value; // Assuming you have a barcode input with id="barcode"
        // Make an AJAX request to fetch product information based on the barcodeValue
        // Update the input box with the fetched product information
        // Example:
        // document.getElementById('selectedProduct').value = fetchedProductInfo;
    });
</script> -->

