<?php
header('Content-Type: application/json');
include '../../../database.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check if email and password are provided
    if (empty($email) || empty($password)) {
        echo json_encode(['error' => 'Email and password are required']);
        exit();
    }

    try {
        // Prepare the SQL statement to select the user based on email
        $stmt = $pdo->prepare('SELECT * FROM user WHERE email = ?');
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists
        if (!$user) {
            echo json_encode(['error' => 'Invalid email or password']);
            exit();
        }

        // Compare the provided password with the stored password (no hashing)
        if ($user['password'] !== $password) {
            echo json_encode(['error' => 'Invalid email or password']);
            exit();
        }

        // If successful, return user details (omit password)
        unset($user['password']); // Don't return the password
        echo json_encode(['success' => 'Login successful', 'user' => $user]);

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Login failed: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
