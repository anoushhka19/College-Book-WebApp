<?php
include('header.php');
include('sidebar.php');
//session_start();
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
        
        $target = "pics/";
        $target = $target.basename( $_FILES['pic']['name']);
        $Filename=basename( $_FILES['pic']['name']);
        if(move_uploaded_file($_FILES['pic']['tmp_name'], $target)) {
            
            $teacherProfile='http://localhost/CollegeBook/pics/'.basename( $_FILES['pic']['name']);
       }else{
            $teacherProfile='';
       }
       
        $status="live";
        
            $query="UPDATE student SET  teacher_id_fk = '". $teacherId ."',studName = '". $FullName ."', email = '". $Email ."', pass = '". $password ."', usertype_id_fk = '". $usertype ."', dept_id_fk = '". $dept_id ."', semester = '". $semster ."', section = '". $section ."', Guardian = '". $Guardian ."',creationStatus = '". $status ."',studentProfile='". $teacherProfile ."' WHERE stud_id ='". $studId ."'";
        
        mysqli_query($con,$query);
            }

         

            $email = $_SESSION["email"];
             $sql="SELECT * FROM student WHERE `creationStatus`='live' AND email='$email'";
            
                $res = mysqli_query($con,$sql);
            while($row=mysqli_fetch_assoc($res)){
                  
                 
                $id=$row['stud_id']; 
                $teacher_id_fk=$row['teacher_id_fk'];                               
                $FullName = $row['studName'];
                $Email = $row['email'];
                $password = $row['pass'];
                $usertype = $row['usertype_id_fk'];
                $dept_id_fk=$row['dept_id_fk'];
                $semster = $row['semester'];
                $studentProfile=$row['studentProfile'];
                $section = $row['section'];
                $Guardian=$row['Guardian'];
                
        }
        

?>

</div>
<br><br>
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Student Profile</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Profile</label>
                                                <input class="form-control py-4" name="pic" id="pic" type="file" /><br><br>
                                                <img src="<?= $studentProfile ?>" height="100px" width="100px" style="border-radius: 95px;height: 180px;width: 200px;"><br><br>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="usertypeid" value="<?= $id ?>">
                                                <input type="hidden" name="teacher_id_fk" value="<?= $teacher_id_fk ?>">
                                                <label class="small mb-1" for="inputEmailAddress">Full Name</label>
                                                <input class="form-control py-4" name="FullName" id="FullName" type="text" placeholder="Enter  Full Name" value="<?= $FullName ?>" required=""/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" name="Email" id="Email" type="email" placeholder="Enter email address" value="<?= $Email ?>" readonly required=""/>
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
                                                <label class="small mb-1" for="inputEmailAddress">Department</label>
                                                <select class="form-control" id="dept" name="dept" required="">
                                                    <option value="">--Select User type--</option>
                                                    <?php
                                                    $sql="SELECT * FROM department WHERE `deptStatus`='live'";

                                                        $res = mysqli_query($con,$sql);
                                                        $i=1;
                                                         while($row=mysqli_fetch_assoc($res)){
                                                 ?>
                                                    <option value="<?= $row['dept_id'] ?>" <?php if($row['dept_id']==$dept_id_fk){ echo "selected";}?>><?= $row['departmentName'] ?></option>
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
                                                <input class="form-control py-4" name="Guardian" id="Guardian" type="text" placeholder="Enter Guardian Name" value="<?= $Guardian ?>" required=""/>
                                            </div>
                                            
                                            
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0" style="padding: 0px 160px;">
                                                <label class="small mb-1" for="inputEmailAddress"></label>
                                                <input type="Submit" name="Add" value="update Profile" class="btn btn-primary">
                                                <input type="reset" name="cancel" value="cancel" class="btn btn-default">
                                                
                                     </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <br><br>
<?php include('footer.php'); ?>