<?php
$id = $_REQUEST['id'];
$n=$_POST['name'];
$c=$_POST['created at'];
$con = mysqli_connect('localhost', 'root', '', 'suffan');
$q = "UPDATE `category` SET `name` = '$n',  `created at` ='$c' WHERE id = '$id'";

$r = mysqli_query($con, $q);

if ($r) {
    header("location: view.php");
} else {
    echo "Update failed: " . mysqli_error($con);
}
mysqli_close($con);
?>
