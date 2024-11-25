<?php
header('Content-Type: application/json');
include '../../../database.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data
    $user_id = $_POST['user_id'] ?? '';
    $email = $_POST['email'] ?? '';

    // Check if at least one identifier (user_id or email) is provided
    if (empty($user_id) && empty($email)) {
        echo json_encode(['error' => 'Either user_id or email must be provided']);
        exit();
    }

    try {
        // Prepare the delete SQL query based on user_id or email
        if (!empty($user_id)) {
            $stmt = $pdo->prepare('DELETE FROM users WHERE user_id = ?');
            $stmt->execute([$user_id]);
        } else {
            $stmt = $pdo->prepare('DELETE FROM users WHERE email = ?');
            $stmt->execute([$email]);
        }

        // Check if any rows were deleted
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => 'User deleted successfully']);
        } else {
            echo json_encode(['error' => 'User not found']);
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Delete failed: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
