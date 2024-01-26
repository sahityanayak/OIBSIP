<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$database = "employee_tasks";

// Create a database connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    
}
if(isset($_POST['Add']))
{
// Handle form submission

    $employee_id = $_POST['employee_id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    // SQL query to insert data into the tasks table (adjust table/column names accordingly)
    $sql = "INSERT INTO tasks (employee_id, title, date, description) VALUES ('$employee_id', '$title', '$date', '$description')";

    if (mysqli_query($conn,$sql) ){
        echo "Task added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}

// Close the database connection
$conn->close();
?>
