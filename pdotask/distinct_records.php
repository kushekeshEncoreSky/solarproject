<?php
include 'db_config.php';

try {
    // Query to get distinct departments with managers without using DISTINCT keyword
    $sql = "SELECT e1.* 
            FROM employees e1
            INNER JOIN (
                SELECT MIN(id) as min_id
                FROM employees
                WHERE position = 'Manager'
                GROUP BY department
            ) e2 ON e1.id = e2.min_id";

    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the results
    foreach ($results as $row) {
        echo implode(", ", $row) . "\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


