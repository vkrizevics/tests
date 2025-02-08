<?php
declare(strict_types = 1);

session_start();

$data = json_decode(file_get_contents("php://input"), true);

$_SESSION['currentTest'] = $data['test'] ?? null;

header('Content-Type: application/json');

echo json_encode([$data]);