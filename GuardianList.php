 <?php
include('header.php');
include('sidebar.php');
include('database/config.php');
if(!isset($_SESSION["roll"])){
   header('Location: index.php'); 
}

?>
<?php
    
    if(isset($_POST['Add'])){ 

        $stud_id = $_POST['guradian_id'];
        
        $stud_id_fk=$_POST['stud_id_fk'];
        $noticeTitle = $_POST['noticeTitle'];
        $noticemsg = $_POST['noticemsg'];
        $creationDate = date("Y-m-d");
       
        $noticeStatus="live";
        
        $query="UPDATE guardianNotice SET gnoticeTitle = '". $noticeTitle ."', gnoticeMsg = '". $noticemsg ."', createdDate = '". $creationDate ."', gNoticeStatus = '". $noticeStatus ."' WHERE guardianNoticeId ='". $stud_id ."'";
        
        mysqli_query($con,$query);
        echo "<script>window.location.href = 'GuardianList.php?id=$stud_id_fk';</script>";
        
            }
?>



<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Students All Guaurdian Notice</h1>
                        
                       
                        <div class="card mb-4">
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="users_data" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sr No. </th>
                                                <th>Student Name</th>
                                                <th>Department</th>
                                                <th>Guardian</th>
                                                <th>Notice Title</th>
                                                <th>Notice Message</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                           <?php
                                           $Id=$_GET["id"];
                                           $sql="SELECT * FROM guardianNotice LEFT JOIN student ON  student.`stud_id` = guardianNotice.`stud_id_fk` LEFT JOIN department ON  department.`dept_id` = student.`dept_id_fk` WHERE  guardianNotice.`gNoticeStatus`='live' AND guardianNotice.`stud_id_fk`='$Id'";

                                           // $sql="SELECT * FROM guardianNotice WHERE `gNoticeStatus`='live' AND `stud_id_fk`='$Id'";

                                                $res = mysqli_query($con,$sql);
                                                $i=1;
                                                 while($row=mysqli_fetch_assoc($res)){
                                                 ?>


                                            <tr>
                                                <td><?php echo  $i++; ?></td>
                                                <td><?php echo  $row['studName']; ?></td>
                                                <td><?php echo  $row['departmentName']; ?></td>
                                                <td><?php echo  $row['guardianName']; ?></td>
                                                <td><?php echo  $row['gnoticeTitle']; ?></td>
                                                <td><?php echo  $row['gnoticeMsg']; ?></td>
                                                <td>
                                                   <button title="Edit User Types" class="editType btn btn-primary" data-id="<?= $row['guardianNoticeId'] ?>" data-name="<?= $row['gnoticeTitle'] ?>" data-noticemsg="<?= $row['gnoticeMsg'] ?>" data-gname="<?= $row['guardianName'];?>" data-studIdFk="<?= $row['stud_id_fk'];?>"><i class="fa fa-edit"></i></button>  &nbsp;&nbsp;&nbsp;
                                                      &nbsp;&nbsp;&nbsp;
                                                        <a href="delete.php?table=guardianNotice&column=guardianNoticeId&datacolumn=gNoticeStatus&id=<?= $row['guardianNoticeId'] ?>" onclick="if(confirm('Do You Want To Delete ?')) return true; else return false;"><button title="Delete Department" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
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
          <input type="hidden" name="guradian_id" value="" id="guradian_id" class="form-control"><br>
          <input type="hidden" name="stud_id_fk" id="stud_id_fk"><br>
          <input type="text" name="GuardianName" value="" id="GuardianName" class="form-control"><br>
          <input type="text" name="noticeTitle" id="noticeTitle" placeholder="Enter a Notice Title" class="form-control" required=""><br>
          <textarea name="noticemsg" id="noticemsg" class="form-control" required=""></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" name="Add" class="btn btn-primary" >Update Notice</button>
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
            var typeName = $(this).attr("data-gname");
            var name = $(this).attr("data-name");
            var noticemsg = $(this).attr("data-noticemsg");
            var studIdFk=$(this).attr("data-studIdFk");

            $("#guradian_id").val(typeId);
            $("#stud_id_fk").val(studIdFk);
            $("#GuardianName").val(typeName);
            $("#noticeTitle").val(name);
            $("#noticemsg").val(noticemsg);
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