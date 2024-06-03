<?php
include 'db_config.php';

try {
    // $stmt = $pdo->query("SELECT MAX(salary) as max_salary, MIN(salary) as min_salary FROM employees");
    $maxSalaryQuery = "SELECT name, salary FROM employees ORDER BY salary DESC";
    $maxStmt = $pdo->query($maxSalaryQuery);
    $result = $maxStmt->fetch(PDO::FETCH_ASSOC);

    echo "Max Salary: " ;
    echo "<pre> <br>";
     print_r($result);
     echo "</pre>";
    // echo "Min Salary: " . $result['min_salary'] . "\n";
    // throw new ErrorException("custom error");
} catch (PDOException $e) {
    echo "Error: " .$e->getMessage();
}
?>

