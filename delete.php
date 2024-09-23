<?php
    
    include('database/config.php');
    if(isset($_GET['table'])){ 

        $id = $_GET['id'];
        $column=$_GET['column'];
        $table = $_GET['table'];
        $datacolumn=$_GET['datacolumn'];
       
        $status="delete";
        
        $query="UPDATE $table SET  $datacolumn= '". $status ."' WHERE  $column = $id ";
      // echo $query;exit();
        $res=mysqli_query($con,$query);
        if($res){
            echo "<script>alert('Data Deleted Successfully..');</script>";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            echo "<script>alert('Failed to Delete..');</script>";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

}
?>