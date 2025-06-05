<?php
    $connect = new PDO("mysql:host=localhost;dbname=quyen", "root", "");
    $result = $connect->query("SELECT * FROM meals");
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $meals = [];
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $meals[] = $row;
        }
        echo json_encode($meals, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        $connect->query("UPDATE meals 
                        SET status = 'hidden'
                        WHERE id = $id");

    }

    $connect = null;
?>