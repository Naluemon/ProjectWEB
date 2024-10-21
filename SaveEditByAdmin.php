<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showAlert(title, text, icon) {
            swal.fire({
                title: title,
                timer:1000,
                text: text,
                icon: icon,
                buttons: true,
                dangerMode: true,
            }).then(() => {
                window.location.href = "showdatamember.php"; // เปลี่ยนไปที่หน้าที่ต้องการหลังจากกด OK
            });
        }
    </script>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "timmy"; 
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "UPDATE member SET email = '" . trim($_POST["email"]) . "',
    Password = '" . trim($_POST['Password']) . "',
    Firstname = '" . trim($_POST['Firstname']) . "',
    Lastname = '" . trim($_POST['Lastname']) . "',
    Status = '" . trim($_POST['Status']) . "'
    WHERE UserID = '" . $_POST['UserID'] . "'";

$query = mysqli_query($conn, $sql);

if ($query) {
    // ถ้าแก้ไขข้อมูลสำเร็จ
    echo "<script>showAlert('สำเร็จ!', 'แก้ไขข้อมูลเรียบร้อยแล้ว', 'success');</script>";
} else {
    // ถ้าเกิดข้อผิดพลาด
    echo "<script>showAlert('ข้อผิดพลาด!', 'เกิดข้อผิดพลาดในการแก้ไขข้อมูล', 'error');</script>";
}

mysqli_close($conn);
?>
</body>
</html>
