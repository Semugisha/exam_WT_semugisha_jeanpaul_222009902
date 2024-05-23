<?php
// Include database connection
include('database_connection.php');
// Check if id is set in the request
if(isset($_REQUEST['id'])) {
    // Get id from the request
    $id = $_REQUEST['id'];
    
    // Prepare and execute SQL query to select attendees data by id
    $stmt = $connection->prepare("SELECT * FROM attendees WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if attendees data is found
    if($result->num_rows > 0) {
        // Fetch attendees data
        $row = $result->fetch_assoc();
        $id = $row['id']; // Store id
        $profile_id = $row['profile_id']; // Store 'profile_id'
        $class_id = $row['class_id']; // Store 'class_id'
        $status = $row['status']; // Store 'status'
        $registered_at = $row['registered_at']; // Store 'registered_at'

    } else {
        echo "attendees not found.";
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
    <!-- Update attendees form -->
    <form method="POST">
        <label for="profile_id">profile_id:</label>
        <!-- Display profile_id from database -->
        <input type="number" name="profile_id" value="<?php echo isset($profile_id) ? $profile_id : ''; ?>">
        <br><br>
        <label for="class_id">class_id:</label>
        <!-- Display class_id from database -->
        <input type="number" name="class_id" value="<?php echo isset($class_id) ? $class_id : ''; ?>">
        <br><br> 

        <label for="status">status:</label>
        <!-- Display status from database -->
        <input type="text" name="status" value="<?php echo isset($status) ? $status : ''; ?>">
        <br><br>

        <label for="registered_at">registered_at:</label>
        <!-- Display registered_at from database -->
        <input type="date" name="registered_at" value="<?php echo isset($registered_at) ? $registered_at : ''; ?>">
        <br><br>

        <!-- Hidden input field to store id -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
        <!-- Submit button to update attendees -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from attendees form
    $registered_at = $_POST['registered_at'];
    $status = $_POST['status'];
    $class_id = $_POST['class_id'];
    $profile_id = $_POST['profile_id'];
    $id = $_POST['id']; 
    
    // Update the attendees in the database
    $stmt = $connection->prepare("UPDATE attendees SET registered_at=?, status=?, class_id=?, profile_id=? WHERE id=?");
    $stmt->bind_param("ssssi", $registered_at, $status, $class_id, $profile_id, $id);
    $stmt->execute();
    
    // Redirect to attendees.php
    header('Location: attendees.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


