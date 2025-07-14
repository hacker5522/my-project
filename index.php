<?php 
include 'Includes/dbcon.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/attnlg.jpg" rel="icon">
    <title>Code Camp BD - Login</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <style>
        .bg-gradient-login {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1546410531-bb4caa6b424d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        
        .login-header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .login-body {
            padding: 30px;
            background: white;
        }
        
        .login-logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 15px;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .user-role-select {
            border-radius: 8px;
            padding: 12px 15px;
        }
    </style>
</head>

<body class="bg-gradient-login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-card">
                    <div class="login-header">
                        <img src="img/logo/attnlg.jpg" class="login-logo">
                        <h4>STUDENT ATTENDANCE SYSTEM</h4>
                        <p class="mb-0">Login to your account</p>
                    </div>
                    <div class="login-body">
                        <form class="user" method="Post" action="">
                            <div class="form-group mb-4">
                                <select required name="userType" class="form-control user-role-select">
                                    <option value="">-- Select User Role --</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="ClassTeacher">Class Teacher</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" class="form-control" required name="username" placeholder="Email Address">
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" name="password" required class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group mb-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="rememberMe">
                                    <label class="custom-control-label" for="rememberMe">Remember me</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-login btn-block" name="login">LOGIN</button>
                            </div>
                        </form>

                        <?php
                        if(isset($_POST['login'])){
                            $userType = $_POST['userType'];
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $password = md5($password);

                            if($userType == "Administrator"){
                                $query = "SELECT * FROM tbladmin WHERE emailAddress = '$username' AND password = '$password'";
                                $rs = $conn->query($query);
                                $num = $rs->num_rows;
                                $rows = $rs->fetch_assoc();

                                if($num > 0){
                                    $_SESSION['userId'] = $rows['Id'];
                                    $_SESSION['firstName'] = $rows['firstName'];
                                    $_SESSION['lastName'] = $rows['lastName'];
                                    $_SESSION['emailAddress'] = $rows['emailAddress'];

                                    echo "<script type = \"text/javascript\">
                                    window.location = (\"Admin/index.php\")
                                    </script>";
                                } else {
                                    echo "<div class='alert alert-danger mt-3' role='alert'>
                                    Invalid Username/Password!
                                    </div>";
                                }
                            }
                            else if($userType == "ClassTeacher"){
                                $query = "SELECT * FROM tblclassteacher WHERE emailAddress = '$username' AND password = '$password'";
                                $rs = $conn->query($query);
                                $num = $rs->num_rows;
                                $rows = $rs->fetch_assoc();

                                if($num > 0){
                                    $_SESSION['userId'] = $rows['Id'];
                                    $_SESSION['firstName'] = $rows['firstName'];
                                    $_SESSION['lastName'] = $rows['lastName'];
                                    $_SESSION['emailAddress'] = $rows['emailAddress'];
                                    $_SESSION['classId'] = $rows['classId'];
                                    $_SESSION['classArmId'] = $rows['classArmId'];

                                    echo "<script type = \"text/javascript\">
                                    window.location = (\"ClassTeacher/index.php\")
                                    </script>";
                                } else {
                                    echo "<div class='alert alert-danger mt-3' role='alert'>
                                    Invalid Username/Password!
                                    </div>";
                                }
                            } else {
                                echo "<div class='alert alert-danger mt-3' role='alert'>
                                Invalid Username/Password!
                                </div>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
</body>
</html>