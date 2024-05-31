<?php
include 'db_config.php';

try {
    // Prepare the SQL query
    $sql = "INSERT INTO Employees (id, name, position, salary, department) VALUES 
            (:id1, :name1, :position1, :salary1, :department1),
            (:id2, :name2, :position2, :salary2, :department2),
            (:id3, :name3, :position3, :salary3, :department3),
            (:id4, :name4, :position4, :salary4, :department4),
            (:id5, :name5, :position5, :salary5, :department5)";
    
    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':id1', $id1);
    $stmt->bindParam(':name1', $name1);
    $stmt->bindParam(':position1', $position1);
    $stmt->bindParam(':salary1', $salary1);
    $stmt->bindParam(':department1', $department1);

    $stmt->bindParam(':id2', $id2);
    $stmt->bindParam(':name2', $name2);
    $stmt->bindParam(':position2', $position2);
    $stmt->bindParam(':salary2', $salary2);
    $stmt->bindParam(':department2', $department2);

    $stmt->bindParam(':id3', $id3);
    $stmt->bindParam(':name3', $name3);
    $stmt->bindParam(':position3', $position3);
    $stmt->bindParam(':salary3', $salary3);
    $stmt->bindParam(':department3', $department3);

    $stmt->bindParam(':id4', $id4);
    $stmt->bindParam(':name4', $name4);
    $stmt->bindParam(':position4', $position4);
    $stmt->bindParam(':salary4', $salary4);
    $stmt->bindParam(':department4', $department4);

    $stmt->bindParam(':id5', $id5);
    $stmt->bindParam(':name5', $name5);
    $stmt->bindParam(':position5', $position5);
    $stmt->bindParam(':salary5', $salary5);
    $stmt->bindParam(':department5', $department5);

    // Assign values to the parameters
    $id1 = 1;
    $name1 = 'nitesh sir';
    $position1 = 'Manager';
    $salary1 = 50000.00;
    $department1 = 'Sales';

    $id2 = 2;
    $name2 = 'satveeer singh ';
    $position2 = 'Developer';
    $salary2 = 60000.00;
    $department2 = 'IT';

    $id3 = 3;
    $name3 = 'rahul  kumawat';
    $position3 = 'Analyst';
    $salary3 = 55000.00;
    $department3 = 'Finance';

    $id4 = 4;
    $name4 = 'Bob Brown';
    $position4 = 'Developer';
    $salary4 = 60000.00;
    $department4 = 'IT';

    $id5 = 5;
    $name5 = 'Carol White';
    $position5 = 'Manager';
    $salary5 = 70000.00;
    $department5 = 'HR';

    // Execute the statement
    $stmt->execute();

    echo "Sample data inserted successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
