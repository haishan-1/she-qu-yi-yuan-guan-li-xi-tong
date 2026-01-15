<?php
header('Content-Type: application/json; charset=utf-8');
require '../db.php';

try {
    $stmt = $pdo->query("SELECT e.emp_id, e.emp_name, e.position, e.title, d.dept_name, e.status 
                         FROM employees e 
                         LEFT JOIN departments d ON e.dept_id = d.dept_id");
    echo json_encode(['code' => 200, 'data' => $stmt->fetchAll()]);
} catch(PDOException $e) {
    echo json_encode(['code' => 500, 'msg' => '查询失败：' . $e->getMessage()]);
}
?>