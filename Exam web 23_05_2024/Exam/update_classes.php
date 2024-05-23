<?php
// Include database connection
include('database_connection.php');
// Check if id is set in the request
if(isset($_REQUEST['id'])) {
    // Get id from the request
    $id = $_REQUEST['id'];
    
    // Prepare and execute SQL query to select classes data by id
    $stmt = $connection->prepare("SELECT * FROM classes WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if classes data is found
    if($result->num_rows > 0) {
        // Fetch classes data
        $row = $result->fetch_assoc();
        $id = $row['id']; // Store id
        $instructor_id = $row['instructor_id']; // Store 'instructor_id'
        $title = $row['title']; // Store 'title'
        $description = $row['description']; // Store 'description'
        $scheduled_at = $row['scheduled_at']; // Store 'scheduled_at'

    } else {
        echo "classes not found.";
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
    <!-- Update classes form -->
    <form method="POST">
        <label for="instructor_id">instructor_id:</label>
        <!-- Display instructor_id from database -->
        <input type="number" name="instructor_id" value="<?php echo isset($instructor_id) ? $instructor_id : ''; ?>">
        <br><br>
        <label for="title">title:</label>
        <!-- Display title from database -->
        <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
        <br><br> 

        <label for="description">description:</label>
        <!-- Display description from database -->
        <input type="text" name="description" value="<?php echo isset($description) ? $description : ''; ?>">
        <br><br>

        <label for="scheduled_at">scheduled_at:</label>
        <!-- Display scheduled_at from database -->
        <input type="date" name="scheduled_at" value="<?php echo isset($scheduled_at) ? $scheduled_at : ''; ?>">
        <br><br>

        <!-- Hidden input field to store id -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
        <!-- Submit button to update classes -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from classes form
    $scheduled_at = $_POST['scheduled_at'];
    $description = $_POST['description'];
    $title = $_POST['title'];
    $instructor_id = $_POST['instructor_id'];
    $id = $_POST['id']; 
    
    // Update the classes in the database
    $stmt = $connection->prepare("UPDATE classes SET scheduled_at=?, description=?, title=?, instructor_id=? WHERE id=?");
    $stmt->bind_param("ssssi", $scheduled_at, $description, $title, $instructor_id, $id);
    $stmt->execute();
    
    // Redirect to classes.php
    header('Location: classes.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


