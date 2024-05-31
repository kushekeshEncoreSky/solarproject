<?php
include 'db_config.php';

try {
    $stmt = $pdo->query("SELECT MAX(salary) as max_salary, MIN(salary) as min_salary FROM Employees");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Max Salary: " . $result['max_salary'] . "\n";
    echo "Min Salary: " . $result['min_salary'] . "\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
