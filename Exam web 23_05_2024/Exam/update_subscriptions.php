<?php
// Include database connection
include('database_connection.php');
// Check if id is set in the request
if(isset($_REQUEST['id'])) {
    // Get id from the request
    $id = $_REQUEST['id'];
    // Prepare and execute SQL query to select subscriptions data by id
    $stmt = $connection->prepare("SELECT * FROM subscriptions WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if subscriptions data is found
    if($result->num_rows > 0) {
        // Fetch subscriptions data
        $row = $result->fetch_assoc();
        $id = $row['id']; // Store id
        $profile_id = $row['profile_id']; // Store 'profile_id'
        $plan = $row['plan']; // Store 'plan'
        $start_date = $row['start_date']; // Store 'start_date'
        $end_date = $row['end_date']; // Store 'end_date'
        $created_at = $row['created_at']; // Store 'created_at'

    } else {
        echo "subscriptions not found.";
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
    <!-- Update subscriptions form -->
    <form method="POST">
        <label for="profile_id">profile_id:</label>
        <!-- Display profile_id from database -->
        <input type="number" name="profile_id" value="<?php echo isset($profile_id) ? $profile_id : ''; ?>">
        <br><br>
        <label for="plan">plan:</label>
        <!-- Display plan from database -->
        <input type="text" name="plan" value="<?php echo isset($plan) ? $plan : ''; ?>">
        <br><br> 

        <label for="start_date">start_date:</label>
        <!-- Display start_date from database -->
        <input type="date" name="start_date" value="<?php echo isset($start_date) ? $start_date : ''; ?>">
        <br><br>

        <label for="end_date">end_date:</label>
        <!-- Display end_date from database -->
        <input type="date" name="end_date" value="<?php echo isset($end_date) ? $end_date : ''; ?>">
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
    // Retrieve updated values from subscriptions form
    $created_at = $_POST['created_at'];
    $end_date = $_POST['end_date'];
    $start_date = $_POST['start_date'];
    $plan = $_POST['plan'];
    $profile_id = $_POST['profile_id'];
    $id = $_POST['id']; 
    
    // Update the subscriptions in the database
    $stmt = $connection->prepare("UPDATE subscriptions SET created_at=?, end_date=?, start_date=?, plan=?, profile_id=? WHERE id=?");
    $stmt->bind_param("sssssi", $created_at, $end_date,  $start_date, $plan, $profile_id, $id);
    $stmt->execute();
    
    // Redirect to subscriptions.php
    header('Location: subscriptions.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


