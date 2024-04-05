<?php
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
$q="INSERT INTO `nut` ( `energy`,`kj`,`fat`,`Saturates`,`carbohydrates`,`sugars`,`protien`,`salt`,`fiber`) VALUES($a,$kj,$fat,$sat,$ca,$su,$pr,$salt,$fi)";
$r=mysqli_query($con,$q);
if($r>0)
	
{
	echo "inserted";
	
	// header('location:show.php');
}
else{
	//echo "not inserted";
	echo mysqli_error($con);
}
?>