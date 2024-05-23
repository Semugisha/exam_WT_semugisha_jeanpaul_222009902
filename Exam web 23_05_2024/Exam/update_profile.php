<?php
// Include database connection
include('database_connection.php');
// Check if id is set in the request
if(isset($_REQUEST['id'])) {
    // Get id from the request
    $id = $_REQUEST['id'];
    
    // Prepare and execute SQL query to select profile data by id
    $stmt = $connection->prepare("SELECT * FROM profile WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if profile data is found
    if($result->num_rows > 0) {
        // Fetch profile data
        $row = $result->fetch_assoc();
        $id = $row['id']; // Store id
        $username = $row['username']; // Store 'username'
        $email = $row['email']; // Store 'email'
        $password = $row['password']; // Store 'password'
        $first_name = $row['first_name']; // Store 'first_name'
        $last_name = $row['last_name']; // Store 'last_name'
        $created_at = $row['created_at']; // Store 'created_at'

    } else {
        echo "profile not found.";
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
    <!-- Update username form -->
    <form method="POST">
        <label for="username">username:</label>
        <!-- Display username from database -->
        <input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>">
        <br><br>
        <label for="email">email:</label>
        <!-- Display email from database -->
        <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <br><br> 

        <label for="password">password:</label>
        <!-- Display password from database -->
        <input type="number" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
        <br><br>

        <label for="first_name">first_name:</label>
        <!-- Display first_name from database -->
        <input type="text" name="first_name" value="<?php echo isset($first_name) ? $first_name : ''; ?>">
        <br><br>

        <label for="last_name">last_name:</label>
        <!-- Display last_name from database -->
        <input type="text" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>">
        <br><br>

        <label for="created_at">created_at:</label>
        <!-- Display created_at from database -->
        <input type="date" name="created_at" value="<?php echo isset($created_at) ? $created_at : ''; ?>">
        <br><br>

        <!-- Hidden input field to store id -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
        <!-- Submit button to update profile -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from profile form
    $created_at = $_POST['created_at'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $id = $_POST['id']; 
    
    // Update the profile in the database
    $stmt = $connection->prepare("UPDATE profile SET created_at=?, last_name=?, first_name=?, password=?, email=?, username=? WHERE id=?");
    $stmt->bind_param("ssssssi", $created_at, $last_name, $first_name, $password, $email, $username, $id);
    $stmt->execute();
    
    // Redirect to profile.php
    header('Location: profile.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


