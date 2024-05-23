<?php
// Include database connection
include('database_connection.php');
// Check if id is set in the request
if(isset($_REQUEST['id'])) {
    // Get id from the request
    $id = $_REQUEST['id'];
    
    // Prepare and execute SQL query to select resources data by id
    $stmt = $connection->prepare("SELECT * FROM resources WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if resources data is found
    if($result->num_rows > 0) {
        // Fetch resources data
        $row = $result->fetch_assoc();
        $id = $row['id']; // Store id
        $class_id = $row['class_id']; // Store 'class_id'
        $resource_name = $row['resource_name']; // Store 'resource_name'
        $resource_type = $row['resource_type']; // Store 'resource_type'
        $resource_url = $row['resource_url']; // Store 'resource_url'

    } else {
        echo "resources not found.";
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
    <!-- Update resources form -->
    <form method="POST">
        <label for="class_id">class_id:</label>
        <!-- Display class_id from database -->
        <input type="number" name="class_id" value="<?php echo isset($class_id) ? $class_id : ''; ?>">
        <br><br>
        <label for="resource_name">resource_name:</label>
        <!-- Display resource_name from database -->
        <input type="text" name="resource_name" value="<?php echo isset($resource_name) ? $resource_name : ''; ?>">
        <br><br> 

        <label for="resource_type">resource_type:</label>
        <!-- Display resource_type from database -->
        <input type="text" name="resource_type" value="<?php echo isset($resource_type) ? $resource_type : ''; ?>">
        <br><br>

        <label for="resource_url">resource_url:</label>
        <!-- Display resource_url from database -->
        <input type="text" name="resource_url" value="<?php echo isset($resource_url) ? $resource_url : ''; ?>">
        <br><br>

        <!-- Hidden input field to store id -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
        <!-- Submit button to update resources -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from resources form
    $resource_url = $_POST['resource_url'];
    $resource_type = $_POST['resource_type'];
    $resource_name = $_POST['resource_name'];
    $class_id = $_POST['class_id'];
    $id = $_POST['id']; 
    
    // Update the resources in the database
    $stmt = $connection->prepare("UPDATE resources SET resource_url=?, resource_type=?, resource_name=?, class_id=? WHERE id=?");
    $stmt->bind_param("ssssi", $resource_url, $resource_type, $resource_name, $class_id, $id);
    $stmt->execute();
    
    // Redirect to resources.php
    header('Location: resources.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


