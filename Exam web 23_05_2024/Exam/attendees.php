<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Attendees Page</title>
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

<body style="background-image: url('./Images/ATT.jpg'); background-repeat: no-repeat; background-size: cover;">
  <header>
    <h1>Attendees</h1>
  </header>
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./logo.jpg" width="90" height="60" alt="logo">
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
  </header>

  <section>
    <h1>Attendees Form</h1>
    <form method="post">
      <label for="id">ID:</label>
      <input type="number" id="id" name="id"><br><br>
      <label for="profile_id">Profile ID:</label>
      <input type="text" id="profile_id" name="profile_id" required><br><br>
      <label for="class_id">Class ID:</label>
      <input type="text" id="class_id" name="class_id" required><br><br>
      <label for="status">Status:</label>
      <input type="text" id="status" name="status" required><br><br>
      <input type="submit" name="add" value="Insert">
    </form>

    <?php
    include('database_connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO attendees (id, profile_id, class_id, status, registered_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $id, $profile_id, $class_id, $status, $registered_at);

        // Set parameters from POST data with validation (optional)
        $id = intval($_POST['id']); // Ensure integer for id
        $profile_id = htmlspecialchars($_POST['profile_id']); // Prevent XSS
        $class_id = htmlspecialchars($_POST['class_id']); // Prevent XSS
        $status = htmlspecialchars($_POST['status']); // Prevent XSS
        $registered_at = date('Y-m-d H:i:s'); // Current date and time

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
    // SQL query to fetch data from attendees table
    $sql = "SELECT * FROM attendees";
    $result = $connection->query($sql);
    ?>
    <center><h2>Table of Attendees</h2></center>
    <table border="5">
      <tr>
        <th>ID</th>
        <th>Profile ID</th>
        <th>Class ID</th>
        <th>Status</th>
        <th>Registered At</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      // Check if there are any attendees
      if ($result->num_rows > 0) {
          // Output data for each row
          while ($row = $result->fetch_assoc()) {
              $id = $row['id']; // Fetch the id
              echo "<tr>
                  <td>" . $row['id'] . "</td>
                  <td>" . $row['profile_id'] . "</td>
                  <td>" . $row['class_id'] . "</td>
                  <td>" . $row['status'] . "</td>
                  <td>" . $row['registered_at'] . "</td>
                  <td><a style='padding:4px' href='delete_attendees.php?id=$id'>Delete</a></td>
                  <td><a style='padding:4px' href='update_attendees.php?id=$id'>Update</a></td>
              </tr>";
          }
      } else {
          echo "<tr><td colspan='7'>No data found</td></tr>";
      }
      // Close the database connection
      $connection->close();
      ?>
    </table>
  </section>

  <footer>
    <center>
      <b><h2>UR CBE BIT &copy; 2024 Designed by: @Jeanpaul Semugisha</h2></b>
    </center>
  </footer>
  <script>
    function toggleDropdown() {
      document.querySelector(".dropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropdown a')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>
</body>
</html>
