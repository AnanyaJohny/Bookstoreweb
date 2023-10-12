<?php
// Database configuration
$host = "localhost";      // Your database host (usually "localhost")
$username = "root";  // Your database username
$password = "";  // Your database password
$database = "CIA3";  // Your database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $genre = $_POST["genre"];

    // Perform server-side validation as needed

    // Insert data into the database
    $sql = "INSERT INTO users (name, email, password, genre) VALUES ('$name', '$email', '$password', '$genre')";
    if ($conn->query($sql) === true) {
        echo "New record created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
