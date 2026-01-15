<?php
header('Content-Type: application/json; charset=utf-8');
require '../db.php';

$date = $_GET['date'] ?? date('Y-m-d');

try {
    $stmt = $pdo->prepare("SELECT SUM(total_amount) AS total_revenue, COUNT(bill_id) AS visit_count FROM billing WHERE DATE(pay_time) = ?");
    $stmt->execute([$date]);
    echo json_encode(['code' => 200, 'data' => $stmt->fetch()]);
} catch(PDOException $e) {
    echo json_encode(['code' => 500, 'msg' => '统计失败：' . $e->getMessage()]);
}
?>