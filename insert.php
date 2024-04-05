<?php
$n=$_POST['pname'];
$q=$_POST['quantity'];
$i=$_POST['ingredients'];
$c=$_POST['category'];
$s=$_POST['supplier'];
$a = $_POST['energy'];
 $kj = $_POST['kj'];
 $fat = $_POST['fat'];
 $sat = $_POST['Saturates'];
 $ca = $_POST['carbohydrates'];
 $su = $_POST['sugars'];
 $pr = $_POST['protein'];
 $salt = $_POST['salt'];
 $fi = $_POST['fiber'];
$con=mysqli_connect('localhost','root','','suffan');
$q="INSERT INTO `product` ( `pname`,`quantity`,`ingredients`,`category`,`supplier`, `energy`,`kj`,`fat`,`Saturates`,`carbohydrates`,`sugars`,`protein`,`salt`,`fiber`) VALUES ('$n','$q','$i','$c','$s','$a','$kj','$fat','$sat','$ca','$su','$pr','$salt','$fi')";
$r=mysqli_query($con,$q);

if($r>0)
	
{
	echo "inserted";
	
header('location:select.php');
}
else{
	//echo "not inserted";
	echo mysqli_error($con);
}
?>