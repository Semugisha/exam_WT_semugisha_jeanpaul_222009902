<?php
include('database_connection.php');

// Check if the query parameter is set
if (isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'attendees' => "SELECT id FROM attendees WHERE id LIKE '%$searchTerm%'",
        'classes' => "SELECT title FROM classes WHERE title LIKE '%$searchTerm%'",
        'feedback' => "SELECT comment FROM feedback WHERE comment LIKE '%$searchTerm%'",
        'instructors' => "SELECT email FROM instructors WHERE email LIKE '%$searchTerm%'",
        'payments' => "SELECT amount FROM payments WHERE amount LIKE '%$searchTerm%'",
        'profile' => "SELECT created_at FROM profile WHERE created_at LIKE '%$searchTerm%'",
        'resources' => "SELECT resource_type FROM resources WHERE resource_type LIKE '%$searchTerm%'",
        'schedules' => "SELECT day_of_week FROM schedules WHERE day_of_week LIKE '%$searchTerm%'",
        'subscriptions' => "SELECT plan FROM subscriptions WHERE plan LIKE '%$searchTerm%'",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>


