<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Feedback Page</title>
  <style>
    /* CSS styles for the page */
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color:pink;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: beige;
    }

    /* Unvisited link */
    a:link {
      color: beige;
    }

    /* Hover effect */
    a:hover {
      background-color: beige;
    }

    /* Active link */
    a:active {
      background-color: burlywood;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px;
      margin-top: 4px;
    }

    input.form-control {
      margin-left: 500px;
      padding: 8px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    /* Header style */
    header {
      background-color: beige;
      padding: 10px;
      text-align: center;
    }
    .dropdown {
    position: relative;
    display: inline;
    margin-right: 10px;

  }
  .dropdown-contents {
    display: none;
    position: absolute;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    left: 0; /* Aligning dropdown contents to the left */
  }
  .dropdown:hover .dropdown-contents {
    display: block;
  }
  .dropdown-contents a {
    color: white;
    padding: 12px 32px;
    text-decoration: none;
    display: block;
  }
  </style>
  </head>

  <header>

<body style="background-image: url('./Images/1.jpg'); background-repeat: no-repeat; background-size: cover;">
  <header>
    <h1>Feedback</h1>
  </header>
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./logo.jpg" width="90" height="60" alt="Logo">
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./home.html">Home</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">About</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">Contact</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./attendees.php"> Attendees</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./classes.php"> Classes</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php"> Feedback</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./instructors.php"> Instructors</a>
  </li>
  </li>  <li style="display: inline; margin-right: 10px;"><a href="./profile.php"> Profile</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./resources.php"> Resources</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./schedules.php"> Schedules</a>
  </li>
<li style="display: inline; margin-right: 10px;"><a href="./subscriptions.php">Subscriptions</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./payments.php">Payments</a>
  </li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

<section>
<h1>Feedback Form</h1>

<form method="post">
    <label for="id">id:</label>
    <input type="number" id="id" name="id"><br><br>

    <label for="profile_id">profile_id:</label>
    <input type="text" id="profile_id" name="profile_id" required><br><br>

    <label for="class_id">class_id:</label>
    <input type="text" id="class_id" name="class_id" required><br><br>

    <label for="rating">rating:</label>
    <input type="text" id="rating" name="rating" required><br><br>

    <label for="comment">comment:</label>
    <input type="text" id="comment" name="comment" required><br><br>

    <input type="submit" name="add" value="Insert">
</form>

<?php
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters with appropriate data types
    $stmt = $connection->prepare("INSERT INTO feedback (id, profile_id, class_id, rating, comment, created_at) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $id, $profile_id, $class_id, $rating, $comment, $created_at);

    // Set parameters from POST data with validation (optional)
    $id = intval($_POST['id']); // Ensure integer for id
    $profile_id = htmlspecialchars($_POST['profile_id']); // Prevent XSS
    $class_id = htmlspecialchars($_POST['class_id']); // Prevent XSS
    $rating = htmlspecialchars($_POST['rating']); // Prevent XSS
    $comment = htmlspecialchars($_POST['comment']); // Prevent XSS
    $created_at = date('Y-m-d H:i:s'); // Current date and time

    // Execute prepared statement with error handling
    if ($stmt->execute()) {
        echo "New record has been added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>

<?php
include('database_connection.php');
// SQL query to fetch data from feedback table
$sql = "SELECT * FROM feedback";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Information Of Feedback</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of Feedback</h2></center>
    <table border="5">
        <tr>
            <th>id</th>
            <th>profile_id</th>
            <th>class_id</th>
            <th>rating</th>
            <th>comment</th>
            <th>created_at</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any feedback
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $id = $row['id']; // Fetch the id
                echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['profile_id'] . "</td>
                    <td>" . $row['class_id'] . "</td>
                    <td>" . $row['rating'] . "</td>
                    <td>" . $row['comment'] . "</td>
                    <td>" . $row['created_at'] . "</td>
                    <td><a style='padding:4px' href='delete_feedback.php?id=$id'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_feedback.php?id=$id'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
  </body>
</section>

<footer>
  <center> 
    <b><h2>UR CBE BIT &copy 2024 Designed by: @Jeanpaul Semugisha</h2></b>
  </center>
</footer>
</body>
</html>
