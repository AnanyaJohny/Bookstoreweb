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
    $bookTitle = $_POST["book_title"];
    
    // SQL query to search for the book in the repository
    $sql = "SELECT * FROM repository WHERE book_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bookTitle);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $bookData = $result->fetch_assoc();
        $authorName = $bookData["author_name"];
        $bookPrice = $bookData["book_price"];
        echo json_encode(array("success" => true, "message" => "Book found in the repository.", "author_name" => $authorName, "book_price" => $bookPrice));
    } else {
        echo json_encode(array("success" => false, "message" => "Book not found in the repository."));
    }
}

$conn->close();
?>
