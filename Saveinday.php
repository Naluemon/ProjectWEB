<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showAlert(title, text, icon) {
            swal.fire({
                title: title,
                timer: 1000,
                text: text,
                icon: icon,
                buttons: true,
                dangerMode: true,
            }).then(() => {
                window.location.href = "Calendar.php"; // เปลี่ยนไปที่หน้าที่ต้องการหลังจากกด OK
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
    $sql = "update events set event ='" . trim($_POST["event"]) . "',
    color = '" . trim($_POST['color']) . "',
    eventDate = '" . trim($_POST['eventDate']) . "',
    eventTime = '" . trim($_POST['eventTime']) . "'
    where id = '" . $_POST['id'] . "'";

    $query = mysqli_query($conn, $sql);
    if ($query) {
        // ถ้าแก้ไขข้อมูลสำเร็จ
        echo "<script>showAlert('SUCCESS!', 'The information has been edited.', 'success');</script>";
    } else {
        // ถ้าเกิดข้อผิดพลาด
        echo "<script>showAlert('Error!', 'An error occurred while editing data.', 'error');</script>";
    }

    mysqli_close($conn);
    ?>
</body>

</html>