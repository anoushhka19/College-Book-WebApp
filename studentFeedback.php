 <?php
include('header.php');
include('sidebar.php');
if(!isset($_SESSION["roll"])){
   header('Location: index.php'); 
}
    include('database/config.php');
    if(isset($_POST['Add'])){ 

        $stud_id_fk=$_SESSION["Stud_id"];
        $usertypeid = $_POST['usertypeid'];
        
        $teacherId=$_POST['teacherId'];
        $FeedbackTitle=$_POST['FeedbackTitle'];
        $Feedbackmsg=$_POST['Feedbackmsg'];

        $dates=date("Y-m-d");
        $status="live";
        if($usertypeid!=''){
            $query="UPDATE feedback SET stud_id_fk = '". $stud_id_fk ."', teacher_id_fk = '". $teacherId ."', feedbackTitle = '". $FeedbackTitle ."', feedbackMsg = '". $Feedbackmsg ."', feedbackDates = '". $dates ."', feedbackStatus = '". $status ."' WHERE feedbackId ='". $usertypeid ."'";
        }else{
            $query= "INSERT INTO feedback (stud_id_fk, teacher_id_fk,feedbackTitle,feedbackMsg,feedbackDates,feedbackStatus)VALUES('". $stud_id_fk ."','". $teacherId ."','". $FeedbackTitle ."','". $Feedbackmsg ."','". $dates ."','". $status ."')";
        }
        mysqli_query($con,$query);
            }
?>
 <?php


?>
 <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Student Feedback </h1>
                        
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <button class="btn btn-primary" onclick="clear_fun()" data-toggle="modal" data-target="#myModal">Add Feedback</button>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="users_data" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sr No. </th>
                                                <th>Teacher Name</th>
                                                <th>Feedback Title</th>
                                                <th>Feedback Message</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                           <?php
                                           $stud_id_fk1=$_SESSION["Stud_id"];
                                           $sql="SELECT * FROM feedback LEFT JOIN teacher ON  teacher.`teacher_id` = feedback.`teacher_id_fk` LEFT JOIN student ON  student.`stud_id` = feedback.`stud_id_fk` WHERE  feedback.`feedbackStatus`='live' AND feedback.`stud_id_fk`=$stud_id_fk1";



                                            //$sql="SELECT * FROM feedback WHERE `feedbackStatus`='live' AND `stud_id_fk`=$stud_id_fk1";

                                                $res = mysqli_query($con,$sql);
                                                $i=1;
                                                 while($row=mysqli_fetch_assoc($res)){
                                                 ?>


                                            <tr>
                                                <td><?php echo  $i++; ?></td>
                                                <td><?php echo  $row['FullName']; ?></td>
                                                <td><?php echo  $row['feedbackTitle']; ?></td>
                                                <td><?php echo  $row['feedbackMsg']; ?></td>
                                                <td>
                                                    <button title="Edit User Types" class="editType btn btn-primary" data-id="<?= $row['feedbackId'] ?>" data-msg="<?= $row['feedbackMsg'] ?>" data-title="<?= $row['feedbackTitle'] ?>" ><i class="fa fa-edit"></i></button>  &nbsp;&nbsp;&nbsp;
                                                        <a href="delete.php?table=feedback&column=feedbackId&datacolumn=feedbackStatus&id=<?= $row['feedbackId'] ?>" onclick="if(confirm('Do You Want To Delete ?')) return true; else return false;"><button title="Delete Department" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
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
          
          <h4 class="modal-title">Add/Edit Feedback</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="usertypeid" value="" id="usertypeid">
            <input type="hidden" name="teacherId" value="<?= $_SESSION["teacher_ids"] ?>" id="teacherId">
          <input type="text" name="FeedbackTitle" id="FeedbackTitle" placeholder="Enter a Feedback Title" class="form-control" required=""><br>
          <textarea name="Feedbackmsg" id="Feedbackmsg" placeholder="Enter a Feedback Message" required="" class="form-control" required=""></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" name="Add" class="btn btn-primary" >Add Feedback</button>
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
            var title = $(this).attr("data-title");
            var msg = $(this).attr("data-msg");

            $("#usertypeid").val(typeId);
            $("#FeedbackTitle").val(title);
            $("#Feedbackmsg").val(msg);
            
            $("#myModal").modal("show");
        });
        
        $("#editCancel").on('click',function(){
            $("#usertypeid").val("");
        });
    });
    function clear_fun(){
        $("#UserTypeName").val("");
        $('#FeedbackTitle').attr('placeholder','Enter a Feedback Title');
        $('#Feedbackmsg').attr('placeholder','Enter a Feedback Message');
    }
    //*
    </script>

  
               
<?php include('footer.php'); ?>