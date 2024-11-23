<?php
header('Content-Type: application/json');
include '../../../database.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Use plain password, no hashing
    $role = $_POST['role'];

    if (!$name || !$phone || !$address || !$email || !$password || !$role) {
        echo json_encode(['error' => 'All fields are required']);
        exit();
    }

    try {
        $stmt = $pdo->prepare('INSERT INTO user (name, phone, address, email, password, role) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$name, $phone, $address, $email, $password, $role]);
        echo json_encode(['success' => 'User registered successfully']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Registration failed: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
