<?php
include 'db_config.php';

try {
    $stmt = $pdo->query("SELECT * FROM Employees GROUP BY column_name");  // Replace 'column_name' with the actual column you want distinct values for
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $row) {
        echo implode(", ", $row) . "\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
