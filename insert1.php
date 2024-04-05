<?php
$n=$_POST['code'];
$q=$_POST['product no'];
$i=$_POST['use by'];
$c=$_POST['no of lables'];
$b=$_POST['bar code'];
$con=mysqli_connect('localhost','root','','suffan');
$q="INSERT INTO `label` ( `code`,`product no`,`use by`,`no of lables`,`bar code`) VALUES ('$n','$q','$i','$c','$b')";
$r=mysqli_query($con,$q);
if($r>0)
	
{
	// echo "inserted";
	
	header('location:view_labels.php');
}
else{
	//echo "not inserted";
	echo mysqli_error($con);
}
?>