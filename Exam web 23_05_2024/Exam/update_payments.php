<?php
// Include database connection
include('database_connection.php');
// Check if id is set in the request
if(isset($_REQUEST['id'])) {
    // Get id from the request
    $id = $_REQUEST['id'];
    
    // Prepare and execute SQL query to select payments data by id
    $stmt = $connection->prepare("SELECT * FROM payments WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if payments data is found
    if($result->num_rows > 0) {
        // Fetch payments data
        $row = $result->fetch_assoc();
        $id = $row['id']; // Store id
        $profile_id = $row['profile_id']; // Store 'profile_id'
        $amount = $row['amount']; // Store 'amount'
        $payment_date = $row['payment_date']; // Store 'payment_date'
        $status = $row['status']; // Store 'status'

    } else {
        echo "payments not found.";
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
    <!-- Update payments form -->
    <form method="POST">
        <label for="profile_id">profile_id:</label>
        <!-- Display profile_id from database -->
        <input type="number" name="profile_id" value="<?php echo isset($profile_id) ? $profile_id : ''; ?>">
        <br><br>
        <label for="amount">amount:</label>
        <!-- Display amount from database -->
        <input type="number" name="amount" value="<?php echo isset($amount) ? $amount : ''; ?>">
        <br><br> 

        <label for="payment_date">payment_date:</label>
        <!-- Display payment_date from database -->
        <input type="date" name="payment_date" value="<?php echo isset($payment_date) ? $payment_date : ''; ?>">
        <br><br>

        <label for="status">status:</label>
        <!-- Display status from database -->
        <input type="text" name="status" value="<?php echo isset($status) ? $status : ''; ?>">
        <br><br>

        <!-- Hidden input field to store id -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
        <!-- Submit button to update payments -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from payments form
    $status = $_POST['status'];
    $payment_date = $_POST['payment_date'];
    $amount = $_POST['amount'];
    $profile_id = $_POST['profile_id'];
    $id = $_POST['id']; 
    
    // Update the payments in the database
    $stmt = $connection->prepare("UPDATE payments SET status=?, payment_date=?, amount=?, profile_id=? WHERE id=?");
    $stmt->bind_param("ssssi", $status, $payment_date, $amount, $profile_id, $id);
    $stmt->execute();
    
    // Redirect to payments.php
    header('Location: payments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


