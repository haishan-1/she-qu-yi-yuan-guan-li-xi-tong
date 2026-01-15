<?php
header('Content-Type: application/json; charset=utf-8');
require '../db.php';

$visit_id = $_POST['visit_id'] ?? '';
$total_amount = $_POST['total_amount'] ?? '';
$insurance_amount = $_POST['insurance_amount'] ?? 0;
$self_pay_amount = $_POST['self_pay_amount'] ?? '';

if (empty($visit_id) || empty($total_amount) || empty($self_pay_amount)) {
    echo json_encode(['code' => 400, 'msg' => '请填写所有必填项']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO billing(visit_id, total_amount, insurance_amount, self_pay_amount) VALUES (?, ?, ?, ?)");
    $stmt->execute([$visit_id, $total_amount, $insurance_amount, $self_pay_amount]);
    
    $stmt = $pdo->prepare("UPDATE patient_visits SET visit_status = '已离院' WHERE visit_id = ?");
    $stmt->execute([$visit_id]);
    
    echo json_encode(['code' => 200, 'msg' => '结算成功']);
} catch(PDOException $e) {
    echo json_encode(['code' => 500, 'msg' => '结算失败：' . $e->getMessage()]);
}
?>