<?php
header('Content-Type: application/json');
include '../../../database.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? ''; // Use plain password, no hashing

    // Check if any required field is missing
    if (empty($name) || empty($phone) || empty($address) || empty($email) || empty($password)) {
        echo json_encode(['error' => 'All fields are required']);
        exit();
    }

    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare('INSERT INTO users (name, phone, address, email, password) VALUES (?, ?, ?, ?, ?)');
        // Execute the statement with the provided data
        $stmt->execute([$name, $phone, $address, $email, $password]);
        // Return a success message
        echo json_encode(['success' => 'User registered successfully']);
    } catch (PDOException $e) {
        // Return an error message if the registration fails
        echo json_encode(['error' => 'Registration failed: ' . $e->getMessage()]);
    }
} else {
    // Return an error message if the request method is not POST
    echo json_encode(['error' => 'Invalid request method']);
}
?>
