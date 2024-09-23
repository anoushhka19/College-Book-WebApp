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


        $teacherId = $_POST['usertypeid'];
        $FullName = $_POST['FullName'];
        $Email = $_POST['Email'];
        $password = $_POST['password'];
        $usertype = $_POST['usertype'];
        $dept_id=$_POST['dept'];
        $semster = $_POST['semster'];
        $Subject = $_POST['Subject'];
        $section = $_POST['section'];
        $totalStudent=$_POST['totalStudent'];
       
        $status="live";
        if($teacherId!=''){
            $query="UPDATE teacher SET FullName = '". $FullName ."', email = '". $Email ."', pass = '". $password ."', usertype_id_fk = '". $usertype ."', dept_id_fk = '". $dept_id ."', semester = '". $semster ."', subject_id_fk = '". $Subject ."', section = '". $section ."',totalStudent= '". $totalStudent ."',teacherStatus = '". $status ."' WHERE teacher_id ='". $teacherId ."'";
        }else{
            $query= "INSERT INTO teacher (FullName, email,pass,usertype_id_fk,dept_id_fk,semester,subject_id_fk,totalStudent,section,teacherStatus)VALUES('". $FullName ."','". $Email ."','". $password ."','". $usertype ."','". $dept_id ."','". $semster ."','". $Subject ."','". $totalStudent ."','". $section ."','". $status ."')";
        }
        //echo $query;exit();
        mysqli_query($con,$query);
            }

         if(isset($_GET['id'])){ 

            $id = $_GET['id'];
             $sql="SELECT * FROM teacher WHERE `teacherStatus`='live' AND teacher_id =$id";
                $res = mysqli_query($con,$sql);
            while($row=mysqli_fetch_assoc($res)){
                                                 
                $FullName = $row['FullName'];
                $Email = $row['email'];
                $password = $row['pass'];
                $usertype = $row['usertype_id_fk'];
                $dept_id=$row['dept_id_fk'];
                $semster = $row['semester'];
                $Subject = $row['subject_id_fk'];
                $section = $row['section'];
                $totalStudent=$row['totalStudent'];
        }
        }else{
                $id='';
                $FullName = '';
                $Email = '';
                $password = '';
                $usertype = '';
                $dept_id='';
                $semster = '';
                $Subject = '';
                $section = '';
                $totalStudent='';
        }

?>

</div>
<br><br>
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Subject Teacher</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <div class="form-group">
                                                <input type="hidden" name="usertypeid" value="<?= $id ?>">
                                                <label class="small mb-1" for="inputEmailAddress">Full Name</label>
                                                <input class="form-control py-4" name="FullName" id="FullName" type="text" placeholder="Enter  Full Name" value="<?= $FullName ?>" required=""/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" name="Email" id="Email" type="email" placeholder="Enter email address" value="<?= $Email ?>" <?php if($Email==""){?>onKeyup="checkEmail()" <?php }else{?>readonly <?php } ?> required=""/>
                                                <span id="errormsg" style="color:red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" name="password" id="password" type="password" placeholder="Enter password" value="<?= $password ?>" required=""/>
                                            </div>
                                        	<div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">User Type</label>
                                                <select class="form-control" id="usertype" name="usertype" required="">
                                                	<option value="">--Select User type--</option>
                                                    <?php
                                                    $sql="SELECT * FROM usertype WHERE `usertypeStatus`='live'";

                                                        $res = mysqli_query($con,$sql);
                                                        $i=1;
                                                         while($row=mysqli_fetch_assoc($res)){
                                                 ?>
                                                	<option value="<?= $row['usertypeid'] ?>" <?php if($row['usertypeid']==$usertype){ echo "selected";}?>><?= $row['usertypeName'] ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Department</label>
                                                <select class="form-control" id="dept" name="dept" required="">
                                                    <option value="">--Select User type--</option>
                                                    <?php
                                                    $sql="SELECT * FROM department WHERE `deptStatus`='live'";

                                                        $res = mysqli_query($con,$sql);
                                                        $i=1;
                                                         while($row=mysqli_fetch_assoc($res)){
                                                 ?>
                                                    <option value="<?= $row['dept_id'] ?>" <?php if($row['dept_id']==$dept_id){ echo "selected";}?>><?= $row['departmentName'] ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Semester</label>
                                                <select  class="form-control" id="semster" name="semster" required="">
                                                    <option value="" <?php if(""==$semster){ echo "selected";}?>>--Select semester--</option>
                                                    <option value="semster I" <?php if("semster I"==$semster){ echo "selected";}?>>semster I</option>
                                                    <option value="semster II" <?php if("semster II"==$semster){ echo "selected";}?>>semster II</option>
                                                    <option value="semster III" <?php if("semster III"==$semster){ echo "selected";}?>>semster III</option>
                                                    <option value="semster IV" <?php if("semster IV"==$semster){ echo "selected";}?>>semster IV</option>
                                                    <option value="semster V" <?php if("semster V"==$semster){ echo "selected";}?>>semster v</option>
                                                    <option value="semster VI" <?php if("semster VI"==$semster){ echo "selected";}?>>semster VI</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Subject</label>
                                                <select name="Subject" class="form-control" id="Subject" required="">
                                                    <option value="">--Select Subject--</option>
                                                    <?php
                                                     $sql="SELECT * FROM Subject WHERE `subStatus`='live'";

                                                        $res = mysqli_query($con,$sql);
                                                        $i=1;
                                                         while($row=mysqli_fetch_assoc($res)){
                                                 ?>
                                                    <option value="<?= $row['sub_id'] ?>" <?php if($row['sub_id']==$Subject){ echo "selected";}?>><?= $row['subject'] ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Section</label>
                                                <select name="section" class="form-control" id="section" required="">
                                                    <option value="" <?php if(""==$section){ echo "selected";}?> >--Select section--</option>
                                                    <option value="A" <?php if("A"==$section){ echo "selected";}?>>A</option>
                                                    <option value="B" <?php if("B"==$section){ echo "selected";}?>>B</option>
                                                    <option value="C" <?php if("C"==$section){ echo "selected";}?>>C</option>
                                                    <option value="D" <?php if("D"==$section){ echo "selected";}?>>D</option>
                                                    <option value="E" <?php if("E"==$section){ echo "selected";}?>>E</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Total Students</label>
                                                <input class="form-control py-4" name="totalStudent" id="totalStudent" type="text" placeholder="Enter Total Students" value="<?= $totalStudent ?>" required=""/>
                                            </div>
                                            
                                            
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0" style="padding: 0px 160px;">
                                                <label class="small mb-1" for="inputEmailAddress"></label>
                                                <input type="Submit" id="Add" name="Add" value="Add Teacher" class="btn btn-primary">
                                                <input type="reset" name="cancel" value="cancel" class="btn btn-default">
                                                
                                     </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <br><br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    function checkEmail(){
        var email=$("#Email").val();
         $.ajax({
                url: "check_user.php",
                data: {data:email,table:'teacher',col:'email'},
                type: "POST",
                success:function(data){ 
                if(data=="fail"){
                        
                        $('#errormsg').html('This Email is Already Present');
                        $('#Add').prop('disabled', true);
                    }else{
                        $('#errormsg').html('');
                        $('#Add').prop('disabled', false);
                    }
                    
                }
               
           });
    }
</script>
<?php include('footer.php'); ?>