<?php
header('Content-Type: application/json; charset=utf-8');
require '../db.php';

$patient_name = $_POST['patient_name'] ?? '';
$dept_id = $_POST['dept_id'] ?? '';
$contact = $_POST['contact'] ?? '';
$expected_arrive = $_POST['expected_arrive'] ?? '';

if (empty($patient_name) || empty($dept_id) || empty($contact) || empty($expected_arrive)) {
    echo json_encode(['code' => 400, 'msg' => '请填写所有必填项']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO patient_appointments(patient_name, dept_id, contact, expected_arrive) VALUES (?, ?, ?, ?)");
    $stmt->execute([$patient_name, $dept_id, $contact, $expected_arrive]);
    echo json_encode(['code' => 200, 'msg' => '预约成功']);
} catch(PDOException $e) {
    echo json_encode(['code' => 500, 'msg' => '预约失败：' . $e->getMessage()]);
}
?>