 <?php
session_start();
if(!isset($_SESSION["roll"])){
   header('Location: index.php'); 
}
    include('database/config.php');
    if(isset($_POST['Add'])){ 

        $dept_id = $_POST['usertypeid'];
        $department = $_POST['department'];
       
        $status="live";
        if($dept_id!=''){
            $query="UPDATE department SET departmentName = '". $department ."', deptStatus = '". $status ."' WHERE dept_id ='". $dept_id ."'";
        }else{
            $query= "INSERT INTO department (departmentName, deptStatus)VALUES('". $department ."','". $status ."')";
        }
        mysqli_query($con,$query);
            }
?>
 <?php

include('header.php');
include('sidebar.php');
?>
 <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Master :- Department </h1>
                        
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <button class="btn btn-primary" onclick="clear_fun()" data-toggle="modal" data-target="#myModal">Add Department</button>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="users_data" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sr No. </th>
                                                <th>Department</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                           <?php
                                            $sql="SELECT * FROM department WHERE `deptStatus`='live'";

                                                $res = mysqli_query($con,$sql);
                                                $i=1;
                                                 while($row=mysqli_fetch_assoc($res)){
                                                 ?>


                                            <tr>
                                                <td><?php echo  $i++; ?></td>
                                                <td><?php echo  $row['departmentName']; ?></td>
                                                <td>
                                                    <button title="Edit User Types" class="editType btn btn-primary" data-id="<?= $row['dept_id'] ?>" data-name="<?= $row['departmentName'] ?>" ><i class="fa fa-edit"></i></button>  &nbsp;&nbsp;&nbsp;
                                                        <a href="delete.php?table=department&column=dept_id&datacolumn=deptStatus&id=<?= $row['dept_id'] ?>" onclick="if(confirm('Do You Want To Delete ?')) return true; else return false;"><button title="Delete Department" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Add/Edit Department</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="usertypeid" value="" id="usertypeid">
          <input type="text" name="department" id="department" placeholder="Enter a Department" class="form-control" required="">
        </div>
        <div class="modal-footer">
          <button type="submit" name="Add" class="btn btn-primary" >Add Department</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 <script>    
        //*
    $(document).ready(function(){
    
        $(".editType").on('click',function(){
            
            var typeId = $(this).attr("data-id");
            var typeName = $(this).attr("data-name");

            $("#usertypeid").val(typeId);
            $("#department").val(typeName);
            
            $("#myModal").modal("show");
        });
        
        $("#editCancel").on('click',function(){
            $("#usertypeid").val("");
        });
    });
    function clear_fun(){
        $("#department").val("");
        $('input:text').attr('placeholder','Enter a Department');
    }
    //*
    </script>

  
               
<?php include('footer.php'); ?>