<?php
$n=$_POST['name'];
$d=$_POST['designation'];
$c=$_POST['contact'];
$s=$_POST['joindate'];
$con=mysqli_connect('localhost','root','','suffan');
$q="INSERT INTO `staff` ( `name`,`designation`,`contact`,`joindate`) VALUES ('$n','$d','$c','$s')";
$r=mysqli_query($con,$q);
if($r>0)
	
{
	// echo "inserted";
	
	header('location:vieww.php');
}
else{
	//echo "not inserted";
	echo mysqli_error($con);
}
?>