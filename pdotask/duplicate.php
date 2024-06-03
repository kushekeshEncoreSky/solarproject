<?php
include 'db_config.php';

try {
    // Query to get employees with duplicate names
    $duplicateNamesQuery = "
        SELECT e1.*
        FROM employees e1
        INNER JOIN (
            SELECT name
            FROM employees
            GROUP BY name
            HAVING COUNT(*) > 1
        ) e2 ON e1.name = e2.name
    ";

    $stmt = $pdo->query($duplicateNamesQuery);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Employees with Duplicate Names:<br>";
    echo "<pre>";
    print_r($results);
    echo "</pre>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
