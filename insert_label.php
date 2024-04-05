<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<title>Document</title>
</head>
<body>
	<?php
if(isset($_POST['sbt'])){
$n=$_POST['product'];
$d=$_POST['pid'];
$i=$_POST['rate'];
$us=$_POST['useby'];
$in=$_POST['ingredients'];
$con=mysqli_connect('localhost','root','','suffan');
$q="INSERT INTO `label` ( `product`,`pid`,`rate`,`useby`,`ingredients`) VALUES ('$n','$d','$i','$us','$in')";
$r=mysqli_query($con,$q);
if($r>0)
	
{
	//echo "inserted";
	
	 header('location:view_labels.php');
	?>
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>sucess!</strong> Your data saves sucessfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
	<!-- <script>
	alert('data saves sucessfully');
	</script> -->
	<?php
}
else{
	echo "not inserted";
	//echo mysqli_error($con);
}
}
?>
</body>
</html>
