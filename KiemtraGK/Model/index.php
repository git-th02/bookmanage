<?php

$uri = "mysql://avnadmin:AVNS_pt0n0oNeAsyc0OzX6DS@mysql-21ea4eea-test-web-02.l.aivencloud.com:14850/defaultdb?ssl-mode=REQUIRED";


$fields = parse_url($uri);

// Build the DSN including SSL settings
$conn = "mysql:";
$conn .= "host=" . $fields["host"];
$conn .= ";port=" . $fields["port"];
$conn .= ";dbname=defaultdb";
$conn .= ";sslmode=verify-ca;sslrootcert=ca.pem";

try {
  $db = new PDO($conn, $fields["user"], $fields["pass"]);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Tạo bảng Sach
  $db->exec("CREATE TABLE IF NOT EXISTS Sach (
      MaSach INT  PRIMARY KEY,
      TenSach VARCHAR(255) ,
      SoLuong INT 
    )");

  // Tạo bảng User
  $db->exec("CREATE TABLE IF NOT EXISTS User (
      MaUser INT  PRIMARY KEY,
      TenUser VARCHAR(255) ,
      MatKhau VARCHAR(255) 
    )");
// Xoa du lieu cũ 
  $db->exec("DELETE FROM Sach");

  // Chèn dữ liệu vào bảng Sach
  $db->exec("INSERT INTO Sach (MaSach, TenSach, SoLuong) VALUES 
    (1, 'Sách A', 10),
    (2, 'Sách B', 5),
    (3, 'Sách C', 8),
    (4, 'Sách D', 3),
    (5, 'Sách E', 12)");
  
  $db->exec("DELETE FROM User"); // xoa đi bản ghi trc 

  // Chèn dữ liệu vào bảng User
  $db->exec("INSERT INTO User (MaUser, TenUser, MatKhau) VALUES 
    (1,'User A', 'passA'),
    (2, 'User B', 'passB'),
    (3, 'User C', 'passC'),
    (4, 'User D', 'passD'),
    (5, 'User E', 'passE')");

  echo "Thành công!";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
?>

