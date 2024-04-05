<?php
$id=$_REQUEST['id'];
$q="delete from `dispatch` where id='$id'";
$con=mysqli_connect('localhost','root','','suffan');
$r=mysqli_query($con,$q);
if ($r>0)
{
    header('location:view_dispatch.php');
}
else{
    echo mysqli_error($con);
}
?>