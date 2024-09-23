<?php
session_start();
if(!isset($_SESSION["roll"])){
   header('Location: index.php'); 
}

?>
<!DOCTYPE html>
<html lang="en">
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Register To College Book</h3></div>
                                    <div class="card-body">
                                        <form>
                                        	<div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">User Type</label>
                                                <select name="usertype" class="form-control" id="usertype">
                                                	<option value="" selected="" disabled="">--Select User type--</option>
                                                	<option>Admin</option>
                                                	<option>Teacher</option>
                                                	<option>Student</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Full Name</label>
                                                <input class="form-control py-4" id="FullName" type="text" placeholder="Enter  Full Name" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" />
                                            </div>
                                             <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Confirm Password</label>
                                                <input class="form-control py-4" id="confrimPassword" type="password" placeholder="Enter Confirm password" />
                                            </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0" style="padding: 0px 160px;">
                                                <label class="small mb-1" for="inputEmailAddress"></label>
                                                <a class="btn btn-primary" href="index.html">Submit</a>
                                     </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="index.php">Go To Login</a></div>
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
