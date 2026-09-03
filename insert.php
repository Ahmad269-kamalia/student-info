<?php
$servername = "localhost";
$username = "root";      // Aapke XAMPP/WAMP ka default username
$password = "";          // Default password khali hota hai
$dbname = "practice_db";

// Database connection create karein
$conn = new mysqli($servername, $username, $password, $dbname);

// Connection check karein
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check karein ke data POST method se aaya hai ya nahi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Note: Real projects me password hash karte hain (password_hash)
    $message = $_POST['message'];

    // Prepared statement use karna security ke liye behtar hota hai (SQL Injection se bachne ke liye)
    $stmt = $conn->prepare("INSERT INTO info (name, email, password, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $message);

    if ($stmt->execute()) {
        echo "Your message successfully send.<br><a href='index.html'>Submit again</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
