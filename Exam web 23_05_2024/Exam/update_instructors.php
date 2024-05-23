<?php
// Include database connection
include('database_connection.php');
// Check if id is set in the request
if(isset($_REQUEST['id'])) {
    // Get id from the request
    $id = $_REQUEST['id'];
    
    // Prepare and execute SQL query to select instructors data by id
    $stmt = $connection->prepare("SELECT * FROM instructors WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if instructors data is found
    if($result->num_rows > 0) {
        // Fetch instructors data
        $row = $result->fetch_assoc();
        $id = $row['id']; // Store id
        $name = $row['name']; // Store 'name'
        $email = $row['email']; // Store 'email'
        $bio = $row['bio']; // Store 'bio'
        $created_at = $row['created_at']; // Store 'created_at'

    } else {
        echo "instructors not found.";
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
    <!-- Update instructors form -->
    <form method="POST">
        <label for="name">name:</label>
        <!-- Display name from database -->
        <input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
        <br><br>
        <label for="email">email:</label>
        <!-- Display email from database -->
        <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <br><br> 

        <label for="bio">bio:</label>
        <!-- Display bio from database -->
        <input type="text" name="bio" value="<?php echo isset($bio) ? $bio : ''; ?>">
        <br><br>

        <label for="created_at">created_at:</label>
        <!-- Display created_at from database -->
        <input type="date" name="created_at" value="<?php echo isset($created_at) ? $created_at : ''; ?>">
        <br><br>

        <!-- Hidden input field to store id -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
        <!-- Submit button to update instructors -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from instructors form
    $created_at = $_POST['created_at'];
    $bio = $_POST['bio'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $id = $_POST['id']; 
    
    // Update the instructors in the database
    $stmt = $connection->prepare("UPDATE instructors SET created_at=?, bio=?, email=?, name=? WHERE id=?");
    $stmt->bind_param("ssssi", $created_at, $bio, $email, $name, $id);
    $stmt->execute();
    
    // Redirect to instructors.php
    header('Location: instructors.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


