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
                        <br>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><h4> Dashboard : <?php echo $_SESSION["roll"]; ?></h4></li>
                        </ol>
                    <?php if($_SESSION["roll"]=="Admin"){?>
                        <div class="row">
                         <?php   
                            $sql="select count(*) as total from teacher where `teacherStatus`='live'";
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            

                        ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Teachers</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#"> No Of Teacher:- <?= $data['total']; ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        <?php   
                            $sql="select count(*) as total1 from student where `creationStatus`='live'";
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            

                        ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Students</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">No Of Students:-  <?= $data['total1']; ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        <?php   
                            $sql="select count(*) as total2 from notice where `noticeStatus`='live'";
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            

                        ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Admin Notice</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Admin Notice No :- <?= $data['total2']; ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        <?php   
                            $sql="select count(*) as total3 from feedback where `feedbackStatus`='live'";
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            

                        ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Student Feedback</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Student Feedback No :- <?= $data['total3']; ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>  
                     <?php if($_SESSION["roll"]=="Teacher"){?>
                        <div class="row">
                         <?php   
                            $sql="select count(*) as total1 from student where `creationStatus`='live'";
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            

                        ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Student</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#"> No Of Student:- <?= $data['total1']; ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        <?php   
                            $sql="select count(*) as total2 from notice where `noticeStatus`='live'";
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            

                        ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Admin Notice</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">No Of Admin Notice:-  <?= $data['total2']; ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        <?php   
                            $teachId=$_SESSION["TeacherId"];
                            $sql="select count(*) as total3 from guardiannotice where `gNoticeStatus`='live' AND `teacher_id_fk`='$teachId'";
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            

                        ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Guardian Notice</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Guardian Notice No :- <?= $data['total3']; ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                     <?php } ?>   
                     <?php if($_SESSION["roll"]=="Student"){ ?>
                        <div class="row">
                         <?php   
                            $sql="select count(*) as total2 from notice where `noticeStatus`='live'";
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            

                        ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Admin Notice </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#"> Admin Notices:- <?= $data['total2']; ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        <?php   
                            $id=$_SESSION["Stud_id"];
                            $sql="select count(*) as total1 from guardiannotice where `gNoticeStatus`='live' AND `stud_id_fk`=$id";
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            

                        ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Students</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">No Of Students:-  <?= $data['total1']; ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        
                        
                        </div>
                    <?php } ?>
                    </div>
                </main>
                
<?php include('footer.php'); ?>