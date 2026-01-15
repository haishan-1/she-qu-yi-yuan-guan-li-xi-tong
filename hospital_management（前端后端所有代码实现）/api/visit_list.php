<?php
header('Content-Type: application/json; charset=utf-8');
require '../db.php';

try {
    $stmt = $pdo->query("SELECT v.visit_id, v.patient_name, d.dept_name, r.room_num, v.visit_status 
                         FROM patient_visits v 
                         LEFT JOIN departments d ON v.dept_id = d.dept_id 
                         LEFT JOIN rooms r ON v.room_id = r.room_id");
    echo json_encode(['code' => 200, 'data' => $stmt->fetchAll()]);
} catch(PDOException $e) {
    echo json_encode(['code' => 500, 'msg' => '查询失败：' . $e->getMessage()]);
}
?>