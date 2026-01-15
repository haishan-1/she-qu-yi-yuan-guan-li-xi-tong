<?php
// 适配你的MySQL端口3307
$host = 'localhost';
$dbname = 'community_hospital';
$username = 'root';
$password = '';
$port = 3307;

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("数据库连接失败: " . $e->getMessage());
}
?>