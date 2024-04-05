<?php
$id = $_REQUEST['id'];
$n=$_POST['name'];
$q=$_POST['created at'];


$con = mysqli_connect('localhost', 'root', '', 'suffan');

$q = "UPDATE `category` SET `name`='$n', `created at`='$q'   WHERE id='$id'";

$r = mysqli_query($con, $q);
if ($r>0) {
    // echo "data updated";
    
    header("location:view.php");
} else {
    // echo "not interested";
    echo "Update failed: " . mysqli_error($con);
}
mysqli_close($con);
?>





