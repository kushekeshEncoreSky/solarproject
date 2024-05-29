<?php
trait Logger {
    public function log($message) {
        echo "Log message: $message<br>";
    }
}

trait FileHandler {
    public function openFile($filename) {
        echo "Opening file: $filename<br>";
    }

    public function readFile($filename) {
        echo "Reading file: $filename<br>";
    }

    public function closeFile($filename) {
        echo "Closing file: $filename<br>";
    }
}

class Application {
    use Logger, FileHandler;

    public function run() {
        $this->log("Application started");
        $this->openFile("data.txt");
        $this->readFile("data.txt");
        $this->closeFile("data.txt");
        $this->log("Application finished");
    }
}

$app = new Application();
$app->run();
?>
