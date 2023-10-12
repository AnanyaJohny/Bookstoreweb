<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "CIA3";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // SQL query to fetch user data
    $sql = "SELECT * FROM users WHERE name = ? AND email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, fetch the user data
        $user = $result->fetch_assoc();
        $storedPassword = $user["password"];

        if (password_verify($password, $storedPassword)) {
            // Successful login
            echo '<script>alert("Hi, ' . $user["name"] . '! You have successfully logged in.");</script>';
        } else {
            // Incorrect password
            echo '<script>alert("Password incorrect. Please try again.");</script>';
        }
    } else {
        // User not found
        echo '<script>alert("Username not found. Please check your credentials.");</script>';
    }
}

$conn->close();
?>
