 <?php
include('header.php');
include('sidebar.php');
if(!isset($_SESSION["roll"])){
   header('Location: index.php'); 
}

?>

<?php
    include('database/config.php');
    if(isset($_POST['Add'])){ 

        $stud_id = $_POST['stud_id'];
        $teacher_id_fk = $_POST['teacher_id_fk'];
        $GuardianName = $_POST['GuardianName'];
        $noticeTitle = $_POST['noticeTitle'];
        $noticemsg = $_POST['noticemsg'];
        $creationDate = date("Y-m-d");
       
        $noticeStatus="live";
        // if($stud_id!=''){
        //     $query="UPDATE guardianNotice SET noticeTitle = '". $noticeTitle ."', noticemsg = '". $noticemsg ."', useridFk = '". $useridFk ."', userRole = '". $userRole ."', creationDate = '". $creationDate ."', noticeStatus = '". $noticeStatus ."' WHERE noticeId ='". $noticeId ."'";
        // }else{
            $query= "INSERT INTO guardianNotice (stud_id_fk, teacher_id_fk,guardianName,gnoticeTitle,gnoticeMsg,createdDate,gNoticeStatus)VALUES('". $stud_id ."','". $teacher_id_fk ."','". $GuardianName ."','". $noticeTitle ."','". $noticemsg ."','". $creationDate ."','". $noticeStatus ."')";
        //}
        mysqli_query($con,$query);
            }
?>


<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Guardian Home </h1>
                        
                       
                        <div class="card mb-4">
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="users_data" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sr No. </th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Department</th>
                                                <th>Semester</th>
                                                <th>Section</th>
                                                <th>Guardian</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                           <?php
                                           $teachId=$_SESSION["TeacherId"];
                                           $sql="SELECT * FROM student  LEFT JOIN department ON  department.`dept_id` = student.`dept_id_fk` WHERE  student.`creationStatus`='live' AND student.`teacher_id_fk`='$teachId'";

                                            

                                                $res = mysqli_query($con,$sql);
                                                $i=1;
                                                 while($row=mysqli_fetch_assoc($res)){
                                                 ?>


                                            <tr>
                                                <td><?php echo  $i++; ?></td>
                                                <td><?php echo  $row['studName']; ?></td>
                                                <td><?php echo  $row['email']; ?></td>
                                                <td><?php echo  $row['pass']; ?></td>
                                                <td><?php echo  $row['departmentName']; ?></td>
                                                <td><?php echo  $row['semester']; ?></td>
                                                <td><?php echo  $row['section']; ?></td>
                                                <td><?php echo  $row['Guardian']; ?></td>
                                                <td>
                                                     <button class="editType btn btn-primary"  data-id="<?= $row['stud_id'];?>" data-gname="<?= $row['Guardian'];?>" data-teacherid="<?= $row['teacher_id_fk'];?>" data-toggle="modal" data-target="#myModal">Add Guardian Notice</button>&nbsp;&nbsp;&nbsp;
                                                     <a href="GuardianList.php?id=<?= $row['stud_id'] ?>"><button  class="btn btn-primary"><i class="fa fa-eye"></i></button></a>
                                                      
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
          
          <h4 class="modal-title">Add/Edit Guardian Notice</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="stud_id" value="" id="stud_id" class="form-control"><br>
          <input type="hidden" name="teacher_id_fk" value="" id="teacher_id_fk" class="form-control"><br>
          <input type="text" name="GuardianName" value="" id="GuardianName" class="form-control" required=""><br>
          <input type="text" name="noticeTitle" id="noticeTitle" placeholder="Enter a Notice Title" class="form-control" required=""><br>
          <textarea name="noticemsg" id="noticemsg" class="form-control" required=""></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" name="Add" class="btn btn-primary" >Add Notice</button>
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
            var teacherid = $(this).attr("data-teacherid");
            var typeName = $(this).attr("data-gname");
           

            $("#stud_id").val(typeId);
            $("#teacher_id_fk").val(teacherid);
            $("#GuardianName").val(typeName);
            $("#myModal").modal("show");
        });
        
        $("#editCancel").on('click',function(){
            $("#usertypeid").val("");
        });
    });
    // function clear_fun(){
    //     $("#noticeTitle").val("");
    //     $("#noticemsg").val("");
    //     $("#stud_id").val("");
    //     $("#teacher_id_fk").val("");
        
    //     $("#myModal").modal("show");

    //     $('#noticeTitle').attr('placeholder','Enter a Notice Title');
    //     $('#noticemsg').attr('placeholder','Enter a Notice Message');
    // }
    //*
    </script>

    <?php include('footer.php'); ?>