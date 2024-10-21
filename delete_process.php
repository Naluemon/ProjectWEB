<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "timmy"; //ฐานข้อมูลที่สร้างไว้แล้ว

//เชื่อมต่อกับฐานข้อมูล
$conn = mysqli_connect($servername, $username, $password, $dbname);
$UserID = $_GET["UserID"];
$sql = "DELETE FROM member WHERE UserID = '" . mysqli_real_escape_string($conn, $UserID) . "'"; // ใช้ mysqli_real_escape_string เพื่อป้องกัน SQL Injection
$query = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn)) {
    // ใช้ SweetAlert2 แสดงข้อความแจ้งเตือน
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            title: 'Deleted!',
            text: 'Your member has been deleted.',
            icon: 'success'
        }).then(() => {
            // รอการกดปุ่ม OK ก่อนรีเฟรชหน้า
            window.location.href = 'showdatamember.php'; // รีเฟรชหน้าไปที่ showdatamember.php
        });
    </script>
    ";
} else {
    // หากไม่สามารถลบได้
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire('Error!', 'There was an error deleting the member.', 'error');
    </script>
    ";
}

mysqli_close($conn);
?>