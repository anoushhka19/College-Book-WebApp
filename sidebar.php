<?php session_start();?>
<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <?php if($_SESSION["roll"]=="Admin"){?>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Home
                            </a>
                            <a class="nav-link" href="userType.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-List"></i></div>
                                User Type Master
                            </a>
                            <a class="nav-link" href="department.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-List"></i></div>
                                Department
                            </a>
                            <a class="nav-link" href="subjects.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                                Subject
                            </a>
                             <a class="nav-link" href="noticeHome.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
                                Admin Notice
                            </a>
                             <a class="nav-link" href="studentMsgForAdmin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
                                Student Message
                            </a>
                            <a class="nav-link" href="TeacherHome.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Teacher
                            </a>
                         <?php } ?>
                         <?php if($_SESSION["roll"]=="Teacher"){?>
                              <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Home
                              </a>
                               <a class="nav-link" href="TeacherProfile.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    Profile
                               </a>
                               <a class="nav-link" href="TeacherAdminNotice.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    college Notices
                               </a>
                               <a class="nav-link" href="studentHome.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    Add Students
                               </a>
                               <a class="nav-link" href="guardianNotice.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    Guardian Notices
                               </a>

                         <?php }if($_SESSION["roll"]=="Student"){?>
                              <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Home
                               </a>
                               <a class="nav-link" href="StudentProfile.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    Profile
                               </a>
                               <a class="nav-link" href="TeacherAdminNotice.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    college Notices
                               </a>
                               <a class="nav-link" href="studentGuardianNotice.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    Teacher Notices
                               </a>
                               <a class="nav-link" href="studentFeedback.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    Feedback To Admin
                               </a>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION["roll"]; ?>
                    </div>
                </nav>
            </div>