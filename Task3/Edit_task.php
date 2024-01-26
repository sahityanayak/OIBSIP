<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Edit Task</h2>

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

            $selectSql = "SELECT * FROM tasks WHERE task_id = ?";
            $stmt = $conn->prepare($selectSql);
            $stmt->bind_param("i", $taskId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Simplified form with minimal styling
                echo '<form method="post" action="Update_task.php">';
                echo '  <label>Employee ID: <input type="text" name="employee_id" value="' . $row['employee_id'] . '" required></label><br>';
                echo '  <label>Task Title: <input type="text" name="title" value="' . $row['title'] . '" required></label><br>';
                echo '  <label>Date of Completion: <input type="date" name="date" value="' . $row['date'] . '" required></label><br>';
                echo '  <label>Task Description: <textarea name="description" required>' . $row['description'] . '</textarea></label><br>';
                echo '  <input type="hidden" name="taskId" value="' . $taskId . '">';
                echo '  <input type="submit" name="Update" value="Update">';
                echo '</form>';
            } else {
                echo 'Task not found';
            }

            $stmt->close();
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
