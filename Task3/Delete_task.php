<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "employee_tasks";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["taskId"])) {
    $taskId = $_GET["taskId"];

    $deleteSql = "DELETE FROM tasks WHERE task_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $taskId);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error during task deletion: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
