<?php
header('Content-Type: application/json');
require '../../../database.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get email from the query parameter
    if (isset($_GET['email'])) {
        $email = $_GET['email'];

        try {
            // Prepare the query to fetch user by email
            $stmt = $pdo->prepare('SELECT * FROM user WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            // Check if the user was found
            if ($user) {
                echo json_encode([
                    'status' => 'success',
                    'data' => $user
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
                'msg' => 'Fetching user failed: ' . $e->getMessage()
            ]);
        }
    } else {
        try {
            // Fetch all users
            $stmt = $pdo->prepare('SELECT * FROM user');
            $stmt->execute();
            $users = $stmt->fetchAll();

            // Check if users exist
            if ($users) {
                echo json_encode([
                    'status' => 'success',
                    'data' => $users
                ]);
            } else {
                echo json_encode([
                    'status' => 'failed',
                    'msg' => 'No users found'
                ]);
            }
        } catch (PDOException $e) {
            echo json_encode([
                'status' => 'failed',
                'msg' => 'Fetching users failed: ' . $e->getMessage()
            ]);
        }
    }
} else {
    echo json_encode(['error' => 'Invalid request method. Please use GET']);
}
?>

