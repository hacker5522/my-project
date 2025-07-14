<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';

$query = "SELECT tblclass.className,tblclassarms.classArmName 
FROM tblclassteacher
INNER JOIN tblclass ON tblclass.Id = tblclassteacher.classId
INNER JOIN tblclassarms ON tblclassarms.Id = tblclassteacher.classArmId
Where tblclassteacher.Id = '$_SESSION[userId]'";

$rs = $conn->query($query);
$num = $rs->num_rows;
$rrw = $rs->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="School Attendance Management System">
  <meta name="author" content="">
  <link href="img/logo/attnlg.jpg" rel="icon">
  <title>Attendance Ease | Admin Dashboard</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <style>
    .card {
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .card-icon {
      font-size: 2.5rem;
      opacity: 0.7;
    }
    .stat-number {
      font-size: 2rem;
      font-weight: 700;
    }
    .dashboard-header {
      background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
      color: white;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 30px;
    }
    .breadcrumb {
      background-color: transparent;
      padding: 0;
    }
    .card-body {
      padding: 1.5rem;
    }
  </style>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include "Includes/sidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php include "Includes/topbar.php";?>
        <!-- Topbar -->
        
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="dashboard-header d-flex justify-content-between align-items-center">
            <div>
              <h1 class="h3 mb-1 text-white">Administrator Dashboard</h1>
              <p class="mb-0 text-white-50">Overview of school management system</p>
            </div>
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item"><a href="./" class="text-white">Home</a></li>
              <li class="breadcrumb-item active text-white" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-4">
            <!-- Students Card -->
            <?php 
            $query1=mysqli_query($conn,"SELECT * from tblstudents");                       
            $students = mysqli_num_rows($query1);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Students</div>
                      <div class="stat-number text-gray-800"><?php echo number_format($students);?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users card-icon text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Class Card -->
            <?php 
            $query1=mysqli_query($conn,"SELECT * from tblclass");                       
            $class = mysqli_num_rows($query1);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Classes</div>
                      <div class="stat-number text-gray-800"><?php echo number_format($class);?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chalkboard card-icon text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Class Arm Card -->
            <?php 
            $query1=mysqli_query($conn,"SELECT * from tblclassarms");                       
            $classArms = mysqli_num_rows($query1);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Class Arms</div>
                      <div class="stat-number text-gray-800"><?php echo number_format($classArms);?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-code-branch card-icon text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Std Att Card -->
            <?php 
            $query1=mysqli_query($conn,"SELECT * from tblattendance");                       
            $totAttendance = mysqli_num_rows($query1);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Attendance</div>
                      <div class="stat-number text-gray-800"><?php echo number_format($totAttendance);?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar card-icon text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mb-4">
            <!-- Teachers Card -->
            <?php 
            $query1=mysqli_query($conn,"SELECT * from tblclassteacher");                       
            $classTeacher = mysqli_num_rows($query1);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Class Teachers</div>
                      <div class="stat-number text-gray-800"><?php echo number_format($classTeacher);?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chalkboard-teacher card-icon text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Session and Terms Card -->
            <?php 
            $query1=mysqli_query($conn,"SELECT * from tblsessionterm");                       
            $sessTerm = mysqli_num_rows($query1);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-secondary h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Session & Terms</div>
                      <div class="stat-number text-gray-800"><?php echo number_format($sessTerm);?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-alt card-icon text-secondary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Terms Card -->
            <?php 
            $query1=mysqli_query($conn,"SELECT * from tblterm");                       
            $termonly = mysqli_num_rows($query1);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-dark h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Terms</div>
                      <div class="stat-number text-gray-800"><?php echo number_format($termonly);?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-th card-icon text-dark"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Links Section -->
          <div class="row">
            <div class="col-lg-12 mb-4">
              <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                  <div class="row text-center">
                    <div class="col-md-6 mb-3">
                      <a href="createClass.php" class="btn btn-outline-primary btn-block py-3">
                        <i class="fas fa-plus-circle fa-2x mb-2"></i><br>
                        Add Class
                      </a>
                    </div>
                    <div class="col-md-6 mb-3">
                      <a href="createClassArm.php" class="btn btn-outline-success btn-block py-3">
                        <i class="fas fa-code-branch fa-2x mb-2"></i><br>
                        Add Class Arm
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php include 'includes/footer.php';?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>

</html>