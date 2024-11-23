<?php
header('Content-Type: application/json');
require '../../../database.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if email or id is provided for deletion
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if (!$email && !$id) {
        echo json_encode(['error' => 'Email or ID is required to delete the user']);
        exit();
    }

    try {
        // If email is provided, delete by email, otherwise by ID
        if ($email) {
            // Delete user by email
            $stmt = $pdo->prepare('DELETE FROM user WHERE email = ?');
            $stmt->execute([$email]);
        } else {
            // Delete user by ID
            $stmt = $pdo->prepare('DELETE FROM user WHERE id = ?');
            $stmt->execute([$id]);
        }

        // Check if any rows were affected
        if ($stmt->rowCount() > 0) {
            echo json_encode([
                'status' => 'success',
                'msg' => 'User deleted successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'failed',
                'msg' => 'No user found with the provided email or ID'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'failed',
            'msg' => 'Deletion failed: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode(['error' => $_SERVER['REQUEST_METHOD'] . ' method not allowed. Please use POST method']);
}
?>
