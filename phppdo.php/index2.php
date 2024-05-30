<?php
$dsn = 'mysql:host=your_host;dbname=your_dbname;charset=utf8';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>
<?php
$sql = "INSERT INTO your_table (column1, column2) VALUES (:value1, :value2)";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':value1', $value1);
$stmt->bindParam(':value2', $value2);

$value1 = 'example1';
$value2 = 'example2';

if ($stmt->execute()) {
    echo "Record inserted successfully.";
} else {
    echo "Error inserting record.";
}
?>
<?php
$sql = "UPDATE your_table SET column1 = :value1 WHERE column2 = :value2";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':value1', $value1);
$stmt->bindParam(':value2', $value2);

$value1 = 'new_value';
$value2 = 'example2';

if ($stmt->execute()) {
    echo "Record updated successfully.";
} else {
    echo "Error updating record.";
}
?>
<?php
$sql = "DELETE FROM your_table WHERE column1 = :value1";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':value1', $value1);

$value1 = 'example1';

if ($stmt->execute()) {
    echo "Record deleted successfully.";
} else {
    echo "Error deleting record.";
}
?>
<?php
$sql = "INSERT INTO your_table (column1, column2) VALUES (:value1, :value2)";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':value1', $value1);
$stmt->bindParam(':value2', $value2);

$value1 = 'example1';
$value2 = 'example2';

if ($stmt->execute()) {
    $lastId = $pdo->lastInsertId();
    echo "Record inserted successfully. Last inserted ID is: " . $lastId;
} else {
    echo "Error inserting record.";
}
?>

