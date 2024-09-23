 <?php
include('header.php');
include('sidebar.php');
include('database/config.php');
if(!isset($_SESSION["roll"])){
   header('Location: index.php'); 
}

?>


<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Teacher Home </h1>
                        
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="addTeacher.php"><button class="btn btn-primary">Add Teacher</button></a>
                                
                            </div>
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
                                                <th>Subject</th>
                                                <th>Semester</th>
                                                <th>No Of Students</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                           <?php
                                           $sql="SELECT * FROM teacher LEFT JOIN subject ON  subject.`sub_id` = teacher.`subject_id_fk` LEFT JOIN department ON  department.`dept_id` = teacher.`dept_id_fk` WHERE  teacher.`teacherStatus`='live'";
                                           
                                            

                                                $res = mysqli_query($con,$sql);
                                                $i=1;
                                                 while($row=mysqli_fetch_assoc($res)){
                                                 ?>


                                            <tr>
                                                <td><?php echo  $i++; ?></td>
                                                <td><?php echo  $row['FullName']; ?></td>
                                                <td><?php echo  $row['email']; ?></td>
                                                <td><?php echo  $row['pass']; ?></td>
                                                <td><?php echo  $row['departmentName']; ?></td>
                                                <td><?php echo  $row['subject']; ?></td>
                                                <td><?php echo  $row['semester']; ?></td>
                                                <td><?php echo  $row['totalStudent']; ?></td>
                                                <td>
                                                    <a href="addTeacher.php?id=<?= $row['teacher_id'] ?>"><button  class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                                                      &nbsp;&nbsp;&nbsp;
                                                        <a href="delete.php?table=teacher&column=teacher_id&datacolumn=teacherStatus&id=<?= $row['teacher_id'] ?>" onclick="if(confirm('Do You Want To Delete ?')) return true; else return false;"><button title="Delete Department" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
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
    <?php include('footer.php'); ?>