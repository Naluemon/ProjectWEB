<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <title>Delete Member</title>
</head>

<body>
    <?php
    // เชื่อมต่อกับฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "timmy"; // ฐานข้อมูลที่สร้างไว้แล้ว
    
    // เชื่อมต่อกับฐานข้อมูล
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $UserID = $_GET["UserID"]; // รับ UserID จาก URL
    
    // ใช้ SweetAlert2 แสดงข้อความแจ้งเตือน
    echo "
<script>
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won’t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // ถ้าผู้ใช้ยืนยันการลบ
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'delete_process.php?UserID=" . $UserID . "', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // แสดงข้อความแจ้งเตือนเมื่อการลบเสร็จสิ้น
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Your member has been deleted.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = 'showdatamember.php'; // รีเฟรชหน้าไปที่ showdatamember.php
                    });
                } else {
                    // หากไม่สามารถลบได้
                    Swal.fire('Error!', 'There was an error deleting the member.', 'error');
                }
            };
            xhr.send();
        } else {
            // หากผู้ใช้เลือกยกเลิก
            Swal.fire({
                title: 'Member not deleted',
                icon: 'info'
            }).then(() => {
                window.location.href = 'showdatamember.php'; // กลับไปหน้า showdatamember.php
            });
        }
    });
</script>
";
    mysqli_close($conn);
    ?>
</body>

</html>