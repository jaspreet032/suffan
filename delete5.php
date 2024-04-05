<?php
$id=$_REQUEST['id'];
$q="delete from `label` where id='$id'";
$con=mysqli_connect('localhost','root','','suffan');
$r=mysqli_query($con,$q);
if ($r>0)
{
    header('location:view_labels.php');
}
else{
    echo mysqli_error($con);
}
?>