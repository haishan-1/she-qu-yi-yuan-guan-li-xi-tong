<?php
header('Content-Type: application/json; charset=utf-8');
require '../db.php';

$emp_id = $_POST['emp_id'] ?? '';
$room_id = $_POST['room_id'] ?? '';
$start_time = $_POST['start_time'] ?? '';
$end_time = $_POST['end_time'] ?? '';

if (empty($emp_id) || empty($room_id) || empty($start_time) || empty($end_time)) {
    echo json_encode(['code' => 400, 'msg' => '请填写所有必填项']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO doctor_schedules(emp_id, room_id, start_time, end_time) VALUES (?, ?, ?, ?)");
    $stmt->execute([$emp_id, $room_id, $start_time, $end_time]);
    echo json_encode(['code' => 200, 'msg' => '排班添加成功']);
} catch(PDOException $e) {
    echo json_encode(['code' => 500, 'msg' => '添加失败：' . $e->getMessage()]);
}
?>