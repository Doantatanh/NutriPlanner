<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "nutriplanner";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Kết nối thất bại: " . $conn->connect_error);
}

$fullname = $_POST['fullname'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';
$rating = $_POST['rating'] ?? 0;

$sql = "INSERT INTO feedbacks (fullname, email, message, rating,status, created_at) VALUES (?, ?, ?, ?,0,NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $fullname, $email, $message, $rating);
$stmt->execute();

$conn->close();
?>
