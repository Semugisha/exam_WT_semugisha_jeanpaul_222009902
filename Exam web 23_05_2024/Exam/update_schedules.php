<?php
// Include database connection
include('database_connection.php');
// Check if id is set in the request
if(isset($_REQUEST['id'])) {
    // Get id from the request
    $id = $_REQUEST['id'];
    // Prepare and execute SQL query to select schedules data by id
    $stmt = $connection->prepare("SELECT * FROM schedules WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if schedules data is found
    if($result->num_rows > 0) {
        // Fetch schedules data
        $row = $result->fetch_assoc();
        $id = $row['id']; // Store id
        $class_id = $row['class_id']; // Store 'class_id'
        $day_of_week = $row['day_of_week']; // Store 'day_of_week'
        $start_time = $row['start_time']; // Store 'start_time'
        $end_time = $row['end_time']; // Store 'end_time'
        $created_at = $row['created_at']; // Store 'created_at'

    } else {
        echo "schedules not found.";
    }
}
?>

<html>
<head>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update schedules form -->
    <form method="POST">
        <label for="class_id">class_id:</label>
        <!-- Display class_id from database -->
        <input type="number" name="class_id" value="<?php echo isset($class_id) ? $class_id : ''; ?>">
        <br><br>
        <label for="day_of_week">day_of_week:</label>
        <!-- Display day_of_week from database -->
        <input type="text" name="day_of_week" value="<?php echo isset($day_of_week) ? $day_of_week : ''; ?>">
        <br><br> 

        <label for="start_time">start_time:</label>
        <!-- Display start_time from database -->
        <input type="time" name="start_time" value="<?php echo isset($start_time) ? $start_time : ''; ?>">
        <br><br>

        <label for="end_time">end_time:</label>
        <!-- Display end_time from database -->
        <input type="time" name="end_time" value="<?php echo isset($end_time) ? $end_time : ''; ?>">
        <br><br>

        <label for="created_at">created_at:</label>
        <!-- Display created_at from database -->
        <input type="date" name="created_at" value="<?php echo isset($created_at) ? $created_at : ''; ?>">
        <br><br>

        <!-- Hidden input field to store id -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
        <!-- Submit button to update schedules -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from schedules form
    $created_at = $_POST['created_at'];
    $end_time = $_POST['end_time'];
    $start_time = $_POST['start_time'];
    $day_of_week = $_POST['day_of_week'];
    $class_id = $_POST['class_id'];
    $id = $_POST['id']; 
    
    // Update the schedules in the database
    $stmt = $connection->prepare("UPDATE schedules SET created_at=?, end_time=?, start_time=?, day_of_week=?, class_id=? WHERE id=?");
    $stmt->bind_param("sssssi", $created_at, $end_time,  $start_time, $day_of_week, $class_id, $id);
    $stmt->execute();
    
    // Redirect to schedules.php
    header('Location: schedules.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


