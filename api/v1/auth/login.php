<?php
header('Content-Type: application/json');
include '../../../database.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password']; // Plain password

    if (!$email || !$password) {
        echo json_encode(['error' => 'Email and password are required']);
        exit();
    }

    try {
        $stmt = $pdo->prepare('SELECT * FROM user WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Check if user exists and if the plain password matches
        if ($user && $user['password'] === $password) {
            echo json_encode(['success' => 'Login successful', 'status' => 'true', 'user' => $user]);
        } else {
            echo json_encode(['Msg' => 'Invalid email or password', 'status' => 'false']);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'false',
            'Msg' => 'Login failed: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode(['Msg' => $_SERVER['REQUEST_METHOD'] . ' method not allowed. Please use POST method']);
}
?>
