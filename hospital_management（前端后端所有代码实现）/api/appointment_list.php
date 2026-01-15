<?php
header('Content-Type: application/json; charset=utf-8');
require '../db.php';

try {
    $stmt = $pdo->query("SELECT * FROM patient_appointments WHERE status = '未就诊'");
    echo json_encode(['code' => 200, 'data' => $stmt->fetchAll()]);
} catch(PDOException $e) {
    echo json_encode(['code' => 500, 'msg' => '查询失败：' . $e->getMessage()]);
}
?>