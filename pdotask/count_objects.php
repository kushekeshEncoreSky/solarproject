<?php
include 'db_config.php';

class Employee {
    private static $count = 0;

    public function __construct() {
        self::$count++;
    }

    public static function getCount() {
        return self::$count;
    }
}

// Create some Employee objects to test the counter
$emp1 = new Employee();
$emp2 = new Employee();
$emp3 = new Employee();

echo "Number of Employee objects created: " . Employee::getCount() . "\n";
?>
