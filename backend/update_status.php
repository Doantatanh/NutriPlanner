<?php
require_once '../backend/configuration/Database.php';
$db = new Database();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $stmt = $conn->prepare("UPDATE feedbacks SET status = 1 WHERE id = :id");
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }
    } catch (PDOException $e) {
        echo "error";
    }
}
?>
