<?php
declare(strict_types = 1);

require '../vendor/autoload.php';

session_start();

$data = json_decode(file_get_contents("php://input"), true);

$_SESSION['currentTest'] = $data['test'] ?? null;
$_SESSION['currentQuestion'] = 0;

header('Content-Type: application/json');

echo json_encode([$data]);