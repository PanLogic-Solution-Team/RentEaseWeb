<?php
header('Content-Type: application/json');
require '../../../database.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the form or request body
    $email = $_POST['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = isset($_POST['password']) && !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null; // Optional password update
    $role = $_POST['role'];

    if (!$email || !$name || !$phone || !$address || !$role) {
        echo json_encode(['error' => 'Email, name, phone, address, and role are required']);
        exit();
    }

    try {
        // Check if the user exists based on the provided email
        $stmt = $pdo->prepare('SELECT * FROM user WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // Update the user details based on email
            if ($password) {
                // If the password is provided, update it as well
                $stmt = $pdo->prepare('UPDATE user SET name = ?, phone = ?, address = ?, password = ?, role = ? WHERE email = ?');
                $stmt->execute([$name, $phone, $address, $password, $role, $email]);
            } else {
                // If the password is not provided, update only other fields
                $stmt = $pdo->prepare('UPDATE user SET name = ?, phone = ?, address = ?, role = ? WHERE email = ?');
                $stmt->execute([$name, $phone, $address, $role, $email]);
            }

            echo json_encode([
                'status' => 'success',
                'msg' => 'User information updated successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'failed',
                'msg' => 'No user found with the provided email'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'failed',
            'msg' => 'Update failed: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode(['error' => $_SERVER['REQUEST_METHOD'] . ' method not allowed. Please use POST method']);
}
?>
