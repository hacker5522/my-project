<?php
include '../Includes/dbcon.php';
include '../Includes/session.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $classId = $_POST['classId'];
    $classArmId = $_POST['classArmId'];
    $attendanceDate = $_POST['attendanceDate'];
    $statusArray = $_POST['status'];
    $noteArray = isset($_POST['note']) ? $_POST['note'] : array();
    
    // Check if attendance already exists for this date
    $checkQuery = "SELECT Id FROM tblattendance 
                   WHERE classId = '$classId' 
                   AND classArmId = '$classArmId'
                   AND dateTimeTaken = '$attendanceDate' 
                   LIMIT 1";
    $checkResult = $conn->query($checkQuery);
    
    if($checkResult->num_rows > 0) {
        $_SESSION['error'] = "Attendance for this date already exists!";
        header("Location: dashboard.php");
        exit();
    }
    
    // Begin transaction
    $conn->begin_transaction();
    
    try {
        foreach($statusArray as $studentId => $status) {
            $note = isset($noteArray[$studentId]) ? $conn->real_escape_string($noteArray[$studentId]) : '';
            
            $insertQuery = "INSERT INTO tblattendance 
                            (classId, classArmId, studentId, status, dateTimeTaken, note) 
                            VALUES 
                            ('$classId', '$classArmId', '$studentId', '$status', '$attendanceDate', '$note')";
            
            if(!$conn->query($insertQuery)) {
                throw new Exception("Error recording attendance: " . $conn->error);
            }
        }
        
        $conn->commit();
        $_SESSION['success'] = "Attendance recorded successfully!";
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['error'] = $e->getMessage();
    }
    
    header("Location: dashboard.php");
    exit();
} else {
    header("Location: dashboard.php");
    exit();
}
?>