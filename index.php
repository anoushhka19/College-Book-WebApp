<?php session_start(); ?>
<?php
    include('database/config.php');
    $sql='';
    $sql1='';
    $sql2='';
    $sql3='';
   
    if(isset($_POST['Login'])){ 

        $usertype = $_POST['usertype'];
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];

        if(isset($Email) && isset($Password)){
            
            if($usertype=="Admin"){
                $sql1="SELECT * FROM `Admin` WHERE `adminUser`='$Email' and `AdminPass`='$Password'";
            }else if($usertype=="Teacher"){
                $sql2="SELECT * FROM `teacher` WHERE `email`='$Email' and `pass`='$Password' AND `teacherStatus`='live'";
            }else{
                $sql3="SELECT * FROM `student` WHERE `email`='$Email' and `Pass`='$Password'";
             }
            if($usertype=="Admin"){
                $sql=$sql1;
                $_SESSION["roll"] ='Admin';
            }else if($usertype=="Teacher"){
                $sql=$sql2;
                $_SESSION["roll"] ='Teacher';
            }else{
                $sql=$sql3;
                $_SESSION["roll"] ='Student';
            }
            $res = mysqli_query($con,$sql);
            
             while($row=mysqli_fetch_assoc($res)){

             if(isset($res))
                {
                    if($usertype=="Teacher"){
                        $_SESSION["TeacherId"] = $row['teacher_id'];
                    }
                    if($usertype=="Student"){
                        $_SESSION["Stud_id"] = $row['stud_id'];
                        $_SESSION["teacher_ids"] = $row['teacher_id_fk'];
                    }
                    $_SESSION["email"] = $Email;
                    $_SESSION["pass"] = $Password;
                    echo "<script>alert('Login Successfully..');</script>";
                    echo "<script>window.location.href='dashboard.php';</script>";
                }

            }
            if(!isset($res)){
                    
                    echo "<script>alert('Failed To Login');</script>";
                    header('Location: index.php');
                }
             
             }else{
                    
                    echo "<script>alert('Failed To Login');</script>";
                    header('Location: index.php');
                }   

    }
?>

<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Page Title - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login To College Book</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        	<div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">User Type</label>
                                                <select name="usertype" class="form-control" id="usertype">
                                                	<option value="" selected="" disabled="">--Select User type--</option>
                                                	<option value="Admin">Admin</option>
                                                	<option value="Teacher">Teacher</option>
                                                	<option value="Student">Student</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="Email" name="Email" type="email" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="Password" name="Password" type="password" placeholder="Enter password" />
                                            </div>
                                            
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0" style="padding: 0px 160px;">
                                                    <label class="small mb-1" for="inputEmailAddress"></label>
                                                    <input type="submit" name="Login" value="Login" class="btn btn-primary">
                                                    <!--<a class="btn btn-primary" href="index.html">Login</a>-->
                                         </div>
                                    </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.php">Don't Have an Account yet? Create an Account!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
