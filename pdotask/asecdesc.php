<?php
include 'db_config.php';

try {
    // Query to get data in ascending order by salary
    $ascSalaryQuery = "SELECT name, salary FROM employees ORDER BY salary ASC";
    $ascStmt = $pdo->query($ascSalaryQuery);
    $ascResults = $ascStmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Salaries in Ascending Order:<br>";
    echo "<pre>";
    print_r($ascResults);
    echo "</pre>";

    // Query to get data in descending order by salary
    $descSalaryQuery = "SELECT name, salary FROM employees ORDER BY salary DESC";
    $descStmt = $pdo->query($descSalaryQuery);
    $descResults = $descStmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Salaries in Descending Order:<br>";
    echo "<pre>";
    print_r($descResults);
    echo "</pre>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
