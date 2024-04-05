<?php
$n=$_POST['vendor'];
$q=$_POST['product'];
$i=$_POST['lables'];
$c=$_POST['status'];
$con=mysqli_connect('localhost','root','','suffan');
$q="INSERT INTO `dispatch` ( `vendor`,`product`,`lables`,`status`) VALUES ('$n','$q','$i','$c')";
$r=mysqli_query($con,$q);
if($r>0)
	{
	// echo "inserted";
	
	header('location:view_dispatch.php');
}
else{
	//echo "not inserted";
	echo mysqli_error($con);
}
?>