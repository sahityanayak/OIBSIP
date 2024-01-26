<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tasks</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>View Tasks</h2>

        <!-- Task list to display existing tasks -->
        <div id="taskList">
            <?php
            // Your database connection code (you can include it from a separate file if needed)
            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "employee_tasks";

            $conn = mysqli_connect($host, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch tasks from the database
            if(isset($_POST['employee_id'])) {
                $employeeId = mysqli_real_escape_string($conn, $_POST['employee_id']);
                $sql = "SELECT * FROM tasks WHERE employee_id = '$employeeId'";
                $result = mysqli_query($conn, $sql);
            
                if(!$result) {
                    die("Error: " . mysqli_error($conn));
                }
            
                echo '<ul>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<li id="taskEntry' . $row['task_id'] . '">' .
                        'Task ID: ' . $row['task_id'] .
                        ' | Employee ID: ' . $row['employee_id'] .
                        ' | Title: ' . $row['title'] .
                        ' | Date: ' . $row['date'] .
                        ' | Description: ' . $row['description'] .
                        ' | <button onclick="editTask(' . $row['task_id'] . ')">Edit</button>' .
                        ' | <button onclick="deleteTask(' . $row['task_id'] . ')">Delete</button>' .
                        '</li>';
                }
                echo '</ul>';
            }
            
// Display the form for entering employee ID
?>
<form method="post" action="">
    Enter Employee ID: <input type="text" name="employee_id">
    <input type="submit" value="View Tasks">
</form>

<?php
// Close the database connection
$conn->close();
?>
        </div>

        <!-- JavaScript code for handling task actions -->
        <script>
    function deleteTask(taskId) {
        if (confirm("Are you sure you want to delete this task?")) {
            fetch("Delete_task.php?taskId=" + taskId)
            .then(response => {
                if (response.ok) {
                    // Reload the page after successful deletion
                    location.reload();
                } else {
                    console.error("Error during task deletion. HTTP error:", response.status);
                }
            })
            .catch(error => {
                console.error("Error during task deletion:", error);
            });
        }
    }
    function editTask(taskId) {
                // Redirect to the edit page with the taskId parameter
                window.location.href = "Edit_task.php?taskId=" + taskId;
            }

</script>

    </div>
</body>
</html>
