<?php
header('Content-Type: application/json; charset=utf-8');
require '../db.php';

$appt_id = $_GET['appt_id'] ?? '';
if (empty($appt_id)) {
    echo json_encode(['code' => 400, 'msg' => '无效的预约ID']);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE patient_appointments SET status = '已完成' WHERE appt_id = ?");
    $stmt->execute([$appt_id]);
    echo json_encode(['code' => 200, 'msg' => '预约已标记完成']);
} catch(PDOException $e) {
    echo json_encode(['code' => 500, 'msg' => '操作失败：' . $e->getMessage()]);
}
?>