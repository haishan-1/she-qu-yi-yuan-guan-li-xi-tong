<?php
header('Content-Type: application/json; charset=utf-8');
require '../db.php';

$patient_name = $_POST['patient_name'] ?? '';
$dept_id = $_POST['dept_id'] ?? '';
$contact = $_POST['contact'] ?? '';
$gender = $_POST['gender'] ?? '';
$id_card = $_POST['id_card'] ?? '';
$room_id = $_POST['room_id'] ?? '';
$appt_id = !empty($_POST['appt_id']) ? $_POST['appt_id'] : null;

if (empty($patient_name) || empty($dept_id) || empty($contact) || empty($gender) || empty($id_card) || empty($room_id)) {
    echo json_encode(['code' => 400, 'msg' => '请填写所有必填项']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO patient_visits(appt_id, patient_name, dept_id, contact, gender, id_card, room_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$appt_id, $patient_name, $dept_id, $contact, $gender, $id_card, $room_id]);
    
    if ($appt_id) {
        $stmt = $pdo->prepare("UPDATE patient_appointments SET status = '已完成' WHERE appt_id = ?");
        $stmt->execute([$appt_id]);
    }
    
    echo json_encode(['code' => 200, 'msg' => '就诊登记成功']);
} catch(PDOException $e) {
    echo json_encode(['code' => 500, 'msg' => '登记失败：' . $e->getMessage()]);
}
?>