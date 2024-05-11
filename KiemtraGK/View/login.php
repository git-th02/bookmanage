<?php
session_start();

// Kiểm tra xem người dùng đã gửi dữ liệu đăng nhập chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form đăng nhập
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kiểm tra dữ liệu đăng nhập với cơ sở dữ liệu
    if ($username && $password) {
        // Kết nối đến cơ sở dữ liệu
        require_once '/Applications/XAMPP/xamppfiles/htdocs/bookmanage/Model/index.php';
        

        // Truy vấn để kiểm tra thông tin đăng nhập
        $query = "SELECT * FROM User WHERE TenUser = :username AND MatKhau = :password";
        $statement = $db->prepare($query);
        $statement->execute(array(':username' => $username, ':password' => $password));
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // Nếu có người dùng với thông tin đăng nhập hợp lệ, chuyển hướng đến trang chính
        // (/Applications/XAMPP/xamppfiles/htdocs/bookmanage/Controller/Sach.php)
        if ($user) {
            $_SESSION['username'] = $username;
            header("Location: Sach.php"); // Thay đổi main.php thành trang bạn muốn chuyển hướng sau khi đăng nhập thành công
            exit();
        } else {
            echo "<script>alert('Thông tin đăng nhập không chính xác. Vui lòng thử lại!');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin đăng nhập!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center; color: #f50057">Login BookManage</h1>
        <form action="" method="post">
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <input type="submit" value="Đăng nhập">
        </form>
        <div class="forgot-password">
            <a href="/forgot-password">Forgot Password?</a>
        </div>
        <div class="login-with-social">
            <p style="color: #ccc;">Or, Login with</p>
            <a href="#" class="btn"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="#" class="btn" style="background-color: #f1422d;"><i class="fab fa-google"></i> Google</a>
        </div>
    </div>
</body>
</html>
