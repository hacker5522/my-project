<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';

$query = "SELECT tblclass.className,tblclassarms.classArmName 
          FROM tblclassteacher
          INNER JOIN tblclass ON tblclass.Id = tblclassteacher.classId
          INNER JOIN tblclassarms ON tblclassarms.Id = tblclassteacher.classArmId
          WHERE tblclassteacher.Id = '$_SESSION[userId]'";

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
  <title>Class Teacher Dashboard | <?php echo $rrw['className'].' - '.$rrw['classArmName'];?></title>
  <link href="img/logo/attnlg.jpg" rel="icon">
  
  <!-- CSS -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <style>
    .dashboard-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-left: 4px solid transparent;
    }
    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .card-students { border-left-color: #17a2b8; }
    .card-classes { border-left-color: #4e73df; }
    .card-arms { border-left-color: #1cc88a; }
    .card-attendance { border-left-color: #f6c23e; }
    .welcome-header {
      background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
      color: white;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 30px;
    }
    .quick-actions {
      margin-top: 30px;
    }
    .quick-action-btn {
      padding: 15px;
      text-align: center;
      border-radius: 8px;
      transition: all 0.3s;
    }
    .quick-action-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
  </style>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include "Includes/sidebar.php";?>
    <!-- Sidebar -->
    
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- TopBar -->
      <?php include "Includes/topbar.php";?>
      <!-- Topbar -->
      
      <!-- Main Content -->
      <div class="container-fluid" id="container-wrapper">
        <!-- Welcome Header -->
        <div class="welcome-header">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h1 class="h3 mb-2">Welcome, Class Teacher!</h1>
              <p class="mb-0">You are managing <?php echo $rrw['className'].' - '.$rrw['classArmName'];?></p>
            </div>
            <div class="col-md-4 text-md-right">
              <i class="fas fa-chalkboard-teacher fa-3x opacity-50"></i>
            </div>
          </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
          <?php 
          $students = mysqli_num_rows(mysqli_query($conn,"SELECT * from tblstudents where classId = '$_SESSION[classId]' and classArmId = '$_SESSION[classArmId]'"));
          $class = mysqli_num_rows(mysqli_query($conn,"SELECT * from tblclass"));
          $classArms = mysqli_num_rows(mysqli_query($conn,"SELECT * from tblclassarms"));
          $totAttendance = mysqli_num_rows(mysqli_query($conn,"SELECT * from tblattendance where classId = '$_SESSION[classId]' and classArmId = '$_SESSION[classArmId]'"));
          ?>
          
          <!-- Students Card -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card card-students h-100">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Students</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $students;?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-users fa-2x text-info"></i>
                  </div>
                </div>
                <div class="mt-3">
                  <a href="viewStudents.php" class="text-xs text-info">View Students <i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Classes Card -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card card-classes h-100">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Classes</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $class;?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-chalkboard fa-2x text-primary"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Class Arms Card -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card card-arms h-100">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Class Arms</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $classArms;?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-code-branch fa-2x text-success"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Attendance Card -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card card-attendance h-100">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Total Attendance</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totAttendance;?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-warning"></i>
                  </div>
                </div>
                <div class="mt-3">
                  <a href="takeAttendance.php" class="text-xs text-warning">Take Attendance <i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="row quick-actions">
          <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
              </div>
              <div class="card-body">
                <div class="row text-center">
                  <div class="col-md-4 mb-3">
                    <a href="takeAttendance.php" class="btn btn-primary btn-block quick-action-btn">
                      <i class="fas fa-calendar-check fa-2x mb-2"></i><br>
                      Take Attendance
                    </a>
                  </div>
                  <div class="col-md-4 mb-3">
                    <a href="viewAttendance.php" class="btn btn-success btn-block quick-action-btn">
                      <i class="fas fa-list-ol fa-2x mb-2"></i><br>
                      View Attendance
                    </a>
                  </div>
                  <div class="col-md-4 mb-3">
                    <a href="viewStudents.php" class="btn btn-info btn-block quick-action-btn">
                      <i class="fas fa-users fa-2x mb-2"></i><br>
                      Manage Students
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---Container Fluid-->
      
      <!-- Footer -->
      <?php include 'includes/footer.php';?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Scripts -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>
</html>