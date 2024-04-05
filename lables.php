               <?php
               include 'navbar.php';
               ?>
                <div class="container bg-">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <!-- Product Selection Section -->
      <div class="card mb-3">
        <div class="card-body">
        <div id="productList" style="white-space: nowrap; overflow-y: auto;font-size:19px;">
            <?php
            $con=mysqli_connect('localhost','root','','suffan');
            $q="select * from `product`";
            $r=mysqli_query($con,$q);
            $count = 0; // Counter for products
            echo '<div class="row">'; // Open the row
            while($y=mysqli_fetch_array($r)) {
                if ($count % 4 == 0 && $count !== 0) {
                    echo '</div><div class="row">'; // Close previous row and open new row after every 4 products
                }
                echo '<div class="col-md-3"><div class="product"><span class="badge text-bg-secondary">' . $y['pname'] . '</span></div></div>'; // Each product inside a column
                $count++;
            }
            echo '</div>'; // Close the last row
            ?>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-6">
      <!-- Enter Product Details Section  action="print and insert label.php"-->
      <div class="card  bg-light">
        <div class="card-header text-center">
          <h5>Enter Product Details</h5>
        </div>
        <div class="card-body">
          <form method="post" action="l.php" target="_blank" id="pass">
          <div class="form-group row">
              <label for="product" class="col-sm-4 col-form-label">Product:</label>
              <div class="col-sm-8">
                <input type="text" autocomplete="off" class="form-control" id="myInput" name="product">
                
              </div>
            </div>
            <div class="form-group row">
              <label for="product_id" class="col-sm-4 col-form-label">Product No:</label>
              <div class="col-sm-8">
                <input autocomplete="off" type="text" class="form-control" id="product_id" name="pid">
              </div>
            </div>
            <div class="form-group row">
              <label for="rate" class="col-sm-4 col-form-label">Code:</label>
              <div class="col-sm-8">
                <input autocomplete="off" type="text" class="form-control" id="rate" name="rate">
              </div>
            </div>
            <div class="form-group row">
              <label for="useby" class="col-sm-4 col-form-label">Use By:</label>
              <div class="col-sm-8">
                <input autocomplete="off" type="date" class="form-control" id="useby" name="useby">
              </div>
            </div>
            <div class="form-group row">
              <label for="ingredients" class="col-sm-4 col-form-label">Ingredients:</label>
              <div class="col-sm-8">
                <input autocomplete="off" class="form-control" id="ingredients" name="ingredients">
              </div>
            </div>
            <div class="form-group row">
              <label for="print_qty" class="col-sm-4 col-form-label">Number of Labels:</label>
              <div class="col-sm-8">
                <input class="form-control" id="print_qty" name="print_qty">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg" name="sbt">Submit</button>
              </div>
            </div>
            <!-- Form fields here -->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

        </div>

            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; suffan 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div> 

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script>
    // Add click event listeners to products
    var products = document.querySelectorAll('.product');
    products.forEach(product => {
      product.addEventListener('click', function() {
        // Set the value of the input box 
        document.getElementById('myInput').value = this.innerText;
      });
    });
  </script>
  
</body>

</html>