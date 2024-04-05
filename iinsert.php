<?php
$n=$_POST['name'];
$qq=$_POST['created at'];
$con=mysqli_connect('localhost','root','','suffan');
$q="INSERT INTO `category` ( `name`,`created at`) VALUES ('$n','$qq')";
$r=mysqli_query($con,$q);
if($r>0)
	
{
	// echo "inserted";
	
	header('location:view.php');
}
else{
	//echo "not inserted";
	echo mysqli_error($con);
}
?>