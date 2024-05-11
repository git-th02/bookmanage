<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    // Nếu không, chuyển hướng đến trang đăng nhập
    header("Location: login.php");
    exit();
}

// Kết nối đến cơ sở dữ liệu
require_once '/Applications/XAMPP/xamppfiles/htdocs/bookmanage/Model/index.php';

// Truy vấn để lấy dữ liệu từ bảng Sach
$query = "SELECT * FROM Sach";
$statement = $db->query($query);
$sachList = $statement->fetchAll(PDO::FETCH_ASSOC);

// Biến đếm số dong hiển thị
$rowCount = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sách</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* CSS cho giao diện */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Danh sách Sách</h1>
    <table>
        <thead>
            <tr>
                <th>Mã Sách</th>
                <th>Tên Sách</th>
                <th>Số Lượng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sachList as $sach): ?>
                <?php if ($rowCount < 5): ?> 
                    <tr>  
                        <td><?php echo $sach['MaSach']; ?></td>
                        <td><?php echo $sach['TenSach']; ?></td>
                        <td><?php echo $sach['SoLuong']; ?></td>
                    </tr>
                    <?php $rowCount++; ?>
                <?php else: ?>
                    <?php break; ?>
                <?php endif; ?>        
            <?php endforeach; ?>
        </tbody>
    </table>
    
</body>
</html>
