 <!-- <?php
$con = mysqli_connect('localhost', 'root', '', 'suffan');
$nutritional_info = array();
if(isset($_POST['id']))
{
    $id = $_REQUEST['id']; 
    //Use prepared statement to prevent SQL injection
    $q = "SELECT * FROM `product` where id='$id'";
    $r = mysqli_query($con, $q);
    $y = mysqli_fetch_array($r);
    $energy =$y['energy'];
    $kj =$y['kj'];
    $fat =$y['fat'];
    $saturates=$y['saturates'];
    $carbohydrates=$y['carbohydrates'];
    $sugar=$y['sugar'];
    $protein=$y['protein'];
    $salt=$y['salt'];
    $fiber=$y['fiber'];
    
   
      }
    
    else 
    {
        // Handle database query error more gracefully, e.g., log the error
        error_log("Error: " . mysqli_error($con));
    }



echo "<pre>";

//$y = mysqli_fetch_array($r);
   
    
    
 //var_dump($y);
echo "</pre>";
?> -->
