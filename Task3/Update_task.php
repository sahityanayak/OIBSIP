<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "employee_tasks";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Update"])) {
    $taskId = $_POST["taskId"];
    $employeeId = $_POST["employee_id"];
    $title = $_POST["title"];
    $date = $_POST["date"];
    $description = $_POST["description"];

    // Update task in the database
    $updateSql = "UPDATE tasks SET employee_id = ?, title = ?, date = ?, description = ? WHERE task_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("isssi", $employeeId, $title, $date, $description, $taskId);

    if ($stmt->execute()) {
        echo "Task updated successfully!";
    } else {
        echo "Error updating task: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
