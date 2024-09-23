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


        $studId = $_POST['usertypeid'];
        $teacherId = $_POST['teacher_id_fk'];
        $FullName = $_POST['FullName'];
        $Email = $_POST['Email'];
        $password = $_POST['password'];
        $usertype = $_POST['usertype'];
        $dept_id=$_POST['dept'];
        $semster = $_POST['semster'];
        $Guardian = $_POST['Guardian'];
        $section = $_POST['section'];
        
       
        $status="live";
        if($studId!=''){
            $query="UPDATE student SET  teacher_id_fk = '". $teacherId ."',studName = '". $FullName ."', email = '". $Email ."', pass = '". $password ."', usertype_id_fk = '". $usertype ."', dept_id_fk = '". $dept_id ."', semester = '". $semster ."', section = '". $section ."', Guardian = '". $Guardian ."',creationStatus = '". $status ."' WHERE stud_id ='". $studId ."'";
        }else{
$query= "INSERT INTO student(teacher_id_fk,studName,email,pass,usertype_id_fk,dept_id_fk,semester,section,Guardian,creationStatus)VALUES('". $teacherId ."','". $FullName ."','". $Email ."','". $password ."','". $usertype ."','". $dept_id ."','". $semster ."','". $section ."','". $Guardian ."','". $status ."')";
        }
        //echo $query;exit();
        mysqli_query($con,$query);
            }

         if(isset($_GET['id'])){ 

            $id = $_GET['id'];
             $sql="SELECT * FROM student WHERE `creationStatus`='live' AND teacher_id_fk =$id";
                $res = mysqli_query($con,$sql);
            while($row=mysqli_fetch_assoc($res)){
                
                $teachId=$_SESSION["TeacherId"];                                 
                $FullName = $row['studName'];
                $Email = $row['email'];
                $password = $row['pass'];
                $usertype = $row['usertype_id_fk'];
                $dept_id=$row['dept_id_fk'];
                $semster = $row['semester'];
                $Subject = $row['subject_id_fk'];
                $section = $row['section'];
                $Guardian=$row['Guardian'];
        }
        }else{
                $teachId=$_SESSION["TeacherId"];
                $id='';
                $FullName = '';
                $Email = '';
                $password = '';
                $usertype = '';
                $dept_id='';
                $semster = '';
                $Subject = '';
                $section = '';
                $Guardian='';
        }

?>

</div>
<br><br>
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Student</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <div class="form-group">
                                                <input type="hidden" name="usertypeid" value="<?= $id ?>">
                                                <input type="hidden" name="teacher_id_fk" value="<?= $teachId ?>">
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
                                                <label class="small mb-1" for="inputEmailAddress">Guardian Name</label>
                                                <input class="form-control py-4" name="Guardian" id="Guardian" type="text" placeholder="Enter Guardian Name" value="<?= $Guardian ?>" required=""/>
                                            </div>
                                            
                                            
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0" style="padding: 0px 160px;">
                                                <label class="small mb-1" for="inputEmailAddress"></label>
                                                <input type="Submit" name="Add" id="Add" value="Add Student" class="btn btn-primary">
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
                data: {data:email,table:'student',col:'email'},
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