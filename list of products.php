<div class="container bg-">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <!-- Product Selection Section -->
            <div class="card mb-3">
                <div class="card-body">
                    <div id="productList">
                        <select class="form-select" id="productSelect">
                            <option value="">Select a Product</option>
                            <?php
                            $con = mysqli_connect('localhost', 'root', '', 'suffan');
                            $q = "select * from `product`";
                            $r = mysqli_query($con, $q);
                            while ($y = mysqli_fetch_array($r)) {
                                echo '<option value="' . $y['pname'] . '">' . $y['pname'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>