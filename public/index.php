<?php
require_once __DIR__ . '/../src/Models/Database.php';
require_once __DIR__ . '/../src/Controllers/Controller.php';
require_once __DIR__ . '/../src/Controllers/MainController.php';
require_once __DIR__ . '/../core/MainApp.php';

try {
    $start = new MainApp();
    $start->run();
} catch (PDOException $e) {
    die($e->getMessage());
}
