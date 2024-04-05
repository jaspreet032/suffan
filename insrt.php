<?php
$n=$_POST['name'];
$q=$_POST['contact'];
$i=$_POST['address'];
$c=$_POST['create-at'];
$con=mysqli_connect('localhost','root','','suffan');
$q="INSERT INTO `supplier` ( `name`,`contact`,`address`,`create-at`) VALUES ('$n','$q','$i','$c')";
$r=mysqli_query($con,$q);
if($r>0)
	
{
	// echo "inserted";
	
	header('location:sellect.php');
}
else{
	//echo "not inserted";
	echo mysqli_error($con);
}
?>