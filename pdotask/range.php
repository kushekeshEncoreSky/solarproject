<?php
include 'db_config.php';

try {
    // Establish PDO connection
    $pdo = new PDO("mysql:host=$server;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Define salary range
    $minSalary = 30000; // Example minimum salary
    $maxSalary = 80000; // Example maximum salary

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM employees WHERE salary BETWEEN :minSalary AND :maxSalary";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':minSalary' => $minSalary, ':maxSalary' => $maxSalary]);

    // Fetch and display the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Employees with Salary Between $minSalary and $maxSalary:<br>";
    echo "<pre>";
    print_r($results);
    echo "</pre>";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
