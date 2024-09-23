<?php
include('database/config.php');
if (isset($_POST['data'])) {
    $email = $_POST['data'];
    $table = $_POST['table'];
    $col =$_POST['col'];

    $query = "select * from $table where $col='$email'"; 
    
    $result=mysqli_query($con,$query);
    $row = mysqli_fetch_assoc($result); 

     
		if(isset($row)){
			echo "fail";
		}else{
			echo "";
		}
 }




?>