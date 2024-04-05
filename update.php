<?php
$id = $_REQUEST['id'];
$n = $_POST['pname'];
$q = $_POST['quantity'];
$i = $_POST['ingredients'];
$c = $_POST['category'];
$s = $_POST['supplier'];
$a = $_POST['energy'];
$kj = $_POST['kj'];
$fat = $_POST['fat'];
$sat = $_POST['Saturates'];
$ca = $_POST['carbohydrates'];
$su = $_POST['sugars'];
$pr = $_POST['protein'];
$salt = $_POST['salt'];
$fi = $_POST['fiber'];

$con = mysqli_connect('localhost', 'root', '', 'suffan');

$q = "UPDATE `product` SET `pname` = '$n', `quantity` = '$q', `ingredients` = '$i', `category` = '$c', `supplier` = '$s', `energy` = '$a', `kj` = '$kj', `fat` = '$fat', `Saturates` = '$sat', `carbohydrates` = '$ca', `sugars` = '$su', `protein` = '$pr', `salt` = '$salt', `fiber` = '$fi' WHERE id = '$id'";

$r = mysqli_query($con, $q);

if ($r) {
    header("location: select.php");
} else {
    echo "Update failed: " . mysqli_error($con);
}

mysqli_close($con);
?>
