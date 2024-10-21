
<?php
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('Please login first!'); window.location.href='Login.php';</script>";
    exit;
}

// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "timmy"; // ฐานข้อมูลที่สร้างไว้

$conn = mysqli_connect($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ประมวลผลฟอร์มเมื่อถูกส่ง
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event = $_POST['event'];
    $eventDate = $_POST['eventDate'];
    $eventTime = $_POST['eventTime'];
    $color = $_POST['color'];
    $userid = $_SESSION['userid'];
    $createdBy = ($_SESSION['Status'] === 'ADMIN') ? 'ADMIN' : 'USER'; 

    // คำสั่ง SQL สำหรับการเพิ่มข้อมูล
    $sql = "INSERT INTO events (event, eventDate, eventTime, color, createdBy, userid) 
            VALUES ('$event', '$eventDate', '$eventTime', '$color', '$createdBy', '$userid')";

    // ตรวจสอบผลลัพธ์การเพิ่มข้อมูล
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event = $_POST['event'];
    $eventDate = $_POST['eventDate'];
    $eventTime = $_POST['eventTime'];
    $color = $_POST['color'];
    $userid = $_SESSION['userid'];
    $createdBy = ($_SESSION['Status'] === 'ADMIN') ? 'ADMIN' : 'USER'; 

    // คำสั่ง SQL สำหรับการเพิ่มข้อมูล
    $sql = "INSERT INTO events (event, eventDate, eventTime, color, createdBy, userid) 
            VALUES ('$event', '$eventDate', '$eventTime', '$color', '$createdBy', '$userid')";

    // ตรวจสอบผลลัพธ์การเพิ่มข้อมูล
    if (mysqli_query($conn, $sql)) {
        // ถ้าเพิ่มข้อมูลสำเร็จ
        echo "<script>
                setTimeout(function() {
                    swal.fire({
                        title: 'Success!', // ข้อความ
                        text: 'Event added successfully!', // ข้อความเพิ่มเติม
                        icon: 'success', // ไอคอนสำเร็จ
                        buttons: false // ไม่แสดงปุ่ม
                    });
                }, 100); // แสดงหลังจาก 0.1 วินาที
                setTimeout(function() {
                    window.location.href = 'Calendar.php'; // หน้าเพจที่เราต้องการให้ redirect ไป
                },1000); // redirect หลังจาก 3 วินาที
              </script>";
    } else {
        // ถ้าเพิ่มข้อมูลไม่สำเร็จ
        echo "<script>
                setTimeout(function() {
                    swal.fire({
                        title: 'Failed!', // ข้อความ
                        text: 'Failed to add event.', // ข้อความเพิ่มเติม
                        icon: 'error', // ไอคอนผิดพลาด
                        timer: 3000, // เวลาที่แสดง
                        buttons: false // ไม่แสดงปุ่ม
                    });
                }, 100); // แสดงหลังจาก 0.1 วินาที
              </script>";
    }
}
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
<script>
function showCancelAlert() {
    Swal.fire({
        title: 'กรุณารอสักครู่',
        text: 'กำลังไปยังหน้าปฏิทิน...',
        icon: 'info',
        timer: 1000, // ระยะเวลาแสดงในมิลลิวินาที
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
        },
    }).then(() => {
        window.location.href = 'Calendar.php';
    });
}
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Event</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="TIMMYcss/Head.css" />
    <link rel="stylesheet" href="TIMMYcss/Addevent.css" />
    <!-- โหลด SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<body>
    <div class="headpf">
        <h2><b>Add Event</b></h2>
    </div>
    <div class="container-Pro">
        <form method="POST" action="Addevent.php">
            <div class="form-group">
                <label for="event">Event Name:</label>
                <input type="text" class="form-control-Pro" name="event" placeholder="Event Name" required />
            </div>
            <div class="form-group">  
                <label for="eventDate">Date:</label><br>
                <input type="date" class="form-control-Pro" name="eventDate" required />
            </div>
            <div class="form-group">      
                <label for="eventTime">Time:</label>
                <input type="time" class="form-control-Pro" name="eventTime" />
            </div>
            <div class="form-group">
                <label for="eventColor">Select Color:</label>
                <select class="form-control-Pro" name="color" required>
                    <option value="red">Red</option>
                    <option value="green">Green</option>
                    <option value="blue">Blue</option>
                    <option value="yellow">Yellow</option>
                    <option value="orange">Orange</option>
                </select>
            </div>
            <div class="btn-add-cancle">
                <div class="cancle-event-btn">
                    <button type="button" class="btn btn-danger" onclick="showCancelAlert();">Cancel</button>
                </div>
                <div class="add-event-btn">
                    <button type="submit" class="btn btn-primary">Add Event</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
