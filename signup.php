<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $fullName = $_POST['fullName'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    if (empty($email) || empty($fullName) || empty($username) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $conn = new mysqli("localhost", "root", "", "instagram_clone");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $checkQuery = "SELECT * FROM users WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email or Username already exists.";
        $stmt->close();
        $conn->close();
        exit;
    }

    $insertQuery = "INSERT INTO users (email, full_name, username, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ssss", $email, $fullName, $username, $hashedPassword);

    if ($stmt->execute()) {
        header("Location: home1.html");
        exit;
    } else {
        echo "Signup failed. Please try again.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid Request.";
}
?>
