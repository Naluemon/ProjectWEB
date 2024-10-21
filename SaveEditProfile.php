<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showAlert(title, text, icon) {
            Swal.fire({
                title: title,
                timer: 1000,
                text: text,
                icon: icon,
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = "Profileadmin.php"; // เปลี่ยนไปที่หน้าที่ต้องการหลังจากกด OK
            });
        }
    </script>
</head>

<body>
    <?php
    session_start();
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
    WHERE UserID = '" . $_SESSION['UserID'] . "'";

    try {
        if (mysqli_query($conn, $sql)) {
            echo "<script>showAlert('SUCCESS!', 'The information has been edited.', 'success');</script>";
        } else {
            throw new Exception(mysqli_error($conn));
        }
    } catch (Exception $e) {
        if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
            // ถ้าเกิดข้อผิดพลาด Duplicate entry
            echo "<script>showAlert('Error!', 'This email is taken use other email', 'error');</script>";
        } else {
            echo "<script>showAlert('Error!', 'error: " . $e->getMessage() . "', 'error');</script>";
        }
    }

    mysqli_close($conn);
    ?>
</body>

</html>