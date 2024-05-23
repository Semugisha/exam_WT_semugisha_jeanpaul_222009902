<?php
// Include database connection
include('database_connection.php');
// Check if id is set in the request
if(isset($_REQUEST['id'])) {
    // Get id from the request
    $id = $_REQUEST['id'];
    
    // Prepare and execute SQL query to select feedback data by id
    $stmt = $connection->prepare("SELECT * FROM feedback WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if feedback data is found
    if($result->num_rows > 0) {
        // Fetch feedback data
        $row = $result->fetch_assoc();
        $id = $row['id']; // Store id
        $profile_id = $row['profile_id']; // Store 'profile_id'
        $class_id = $row['class_id']; // Store 'class_id'
        $rating = $row['rating']; // Store 'rating'
        $comment = $row['comment']; // Store 'comment'
        $created_at = $row['created_at']; // Store 'created_at'

    } else {
        echo "feedback not found.";
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
    <!-- Update feedback form -->
    <form method="POST">
        <label for="profile_id">profile_id:</label>
        <!-- Display profile_id from database -->
        <input type="number" name="profile_id" value="<?php echo isset($profile_id) ? $profile_id : ''; ?>">
        <br><br>
        <label for="class_id">class_id:</label>
        <!-- Display class_id from database -->
        <input type="number" name="class_id" value="<?php echo isset($class_id) ? $class_id : ''; ?>">
        <br><br> 

        <label for="rating">rating:</label>
        <!-- Display rating from database -->
        <input type="number" name="rating" value="<?php echo isset($rating) ? $rating : ''; ?>">
        <br><br>

        <label for="comment">comment:</label>
        <!-- Display comment from database -->
        <input type="text" name="comment" value="<?php echo isset($comment) ? $comment : ''; ?>">
        <br><br>

        <label for="created_at">created_at:</label>
        <!-- Display created_at from database -->
        <input type="date" name="created_at" value="<?php echo isset($created_at) ? $created_at : ''; ?>">
        <br><br>

        <!-- Hidden input field to store id -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
        <!-- Submit button to update feedback -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from feedback form
    $created_at = $_POST['created_at'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];
    $class_id = $_POST['class_id'];
    $profile_id = $_POST['profile_id'];
    $id = $_POST['id']; 
    
    // Update the feedback in the database
    $stmt = $connection->prepare("UPDATE feedback SET created_at=?,comment=?, rating=?, class_id=?, profile_id=? WHERE id=?");
    $stmt->bind_param("sssssi", $created_at, $comment,  $rating, $class_id, $profile_id, $id);
    $stmt->execute();
    
    // Redirect to feedback.php
    header('Location: feedback.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


