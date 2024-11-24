<?php
header('Content-Type: application/json');
include '../../../database.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data
    $user_id = $_POST['user_id'] ?? '';
    $email = $_POST['email'] ?? '';
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';

    // Check if at least one identifier (user_id or email) is provided
    if (empty($user_id) && empty($email)) {
        echo json_encode(['error' => 'Either user_id or email must be provided']);
        exit();
    }

    // Check if at least one field to update is provided
    if (empty($name) && empty($phone) && empty($address)) {
        echo json_encode(['error' => 'At least one field (name, phone, address) must be provided']);
        exit();
    }

    try {
        // Prepare the update SQL query based on user_id or email
        if (!empty($user_id)) {
            $stmt = $pdo->prepare('UPDATE user SET name = ?, phone = ?, address = ? WHERE user_id = ?');
            $stmt->execute([$name, $phone, $address, $user_id]);
        } else {
            $stmt = $pdo->prepare('UPDATE user SET name = ?, phone = ?, address = ? WHERE email = ?');
            $stmt->execute([$name, $phone, $address, $email]);
        }

        // Check if any rows were updated
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => 'User updated successfully']);
        } else {
            echo json_encode(['error' => 'No changes made or user not found']);
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Update failed: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
