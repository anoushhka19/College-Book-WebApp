 <?php
session_start();
if(!isset($_SESSION["roll"])){
   header('Location: index.php'); 
}
    include('database/config.php');
    if(isset($_POST['Add'])){ 

        $sub_id = $_POST['usertypeid'];
        $Subject = $_POST['Subject'];
       
        $status="live";
        if($sub_id!=''){
            $query="UPDATE Subject SET subject = '". $Subject ."', subStatus = '". $status ."' WHERE sub_id ='". $sub_id ."'";
        }else{
            $query= "INSERT INTO Subject (subject, subStatus)VALUES('". $Subject ."','". $status ."')";
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
                        <h1 class="mt-4">Master :- Subject </h1>
                        
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <button class="btn btn-primary" onclick="clear_fun()" data-toggle="modal" data-target="#myModal">Add Subject.</button>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="users_data" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sr No. </th>
                                                <th>Subject</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                           <?php
                                            $sql="SELECT * FROM Subject WHERE `subStatus`='live'";

                                                $res = mysqli_query($con,$sql);
                                                $i=1;
                                                 while($row=mysqli_fetch_assoc($res)){
                                                 ?>


                                            <tr>
                                                <td><?php echo  $i++; ?></td>
                                                <td><?php echo  $row['subject']; ?></td>
                                                <td>
                                                    <button title="Edit User Types" class="editType btn btn-primary" data-id="<?= $row['sub_id'] ?>" data-name="<?= $row['subject'] ?>" ><i class="fa fa-edit"></i></button>  &nbsp;&nbsp;&nbsp;
                                                        <a href="delete.php?table=Subject&column=sub_id&datacolumn=subStatus&id=<?= $row['sub_id'] ?>" onclick="if(confirm('Do You Want To Delete ?')) return true; else return false;"><button title="Delete Department" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
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
          
          <h4 class="modal-title">Add/Edit Subjects</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="usertypeid" value="" id="usertypeid">
          <input type="text" name="Subject" id="Subject" placeholder="Enter a Subject" class="form-control" required="">
        </div>
        <div class="modal-footer">
          <button type="submit" name="Add" class="btn btn-primary" >Add Subject</button>
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
            $("#Subject").val(typeName);
            
            $("#myModal").modal("show");
        });
        
        $("#editCancel").on('click',function(){
            $("#usertypeid").val("");
        });
    });
    function clear_fun(){
        $("#Subject").val("");
        $('input:text').attr('placeholder','Enter a Subject');
    }
    //*
    </script>

  
               
<?php include('footer.php'); ?>