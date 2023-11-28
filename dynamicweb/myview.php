<?php
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Website www.anumathew.com</title>
    <link href="mystyle.css" rel="stylesheet"/>
</head>
<body>

<?php
include 'myheader.html';
?>
<div class="content">
    <h2>View students in www.anumathew.com</h2>

    <!-- Search Form -->
    <form method="GET" action="">
        <label for="searchName">Search by Student Name:</label>
        <input type="text" name="searchName" id="searchName" />
        <input type="submit" value="Search" />
    </form>

    <?php
    // Handle search logic
    if (isset($_GET['searchName'])) {
        $searchName = $_GET['searchName'];

        // Validate and sanitize input
        $searchName = mysqli_real_escape_string($conn, $searchName);

        $sql = "SELECT * FROM student WHERE stdname LIKE '%$searchName%'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<h3>Search Results</h3>";
            echo "<table align='center' border='border' width='600' cellpadding='10'>
                  <tr><th>Student Id</th>
                  <th width='250'>Student Name</th> 
                  <th width='250'>Batch</th>
                  <th width='50'>Branch</th>
                  <th width='50'>Age</th>
                  </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo  "<tr><td>".$row["stdid"]. "</td><td>" . $row["stdname"].
                     "</td><td>" . $row["batch"]. "</td><td>" 
                     . $row["branch"]."</td><td>".$row["age"]."</td></tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No results found.</p>";
        }
    } else {
        // Display all students if no search is performed
        $sql = "SELECT * FROM student";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<h3>All Students</h3>";
            echo "<table align='center' border='border' width='600' cellpadding='10'>
                  <tr><th>Student Id</th>
                  <th width='250'>Student Name</th> 
                  <th width='250'>Batch</th>
                  <th width='50'>Branch</th>
                  <th width='50'>Age</th>
                  </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo  "<tr><td>".$row["stdid"]. "</td><td>" . $row["stdname"].
                     "</td><td>" . $row["batch"]. "</td><td>" 
                     . $row["branch"]."</td><td>".$row["age"]."</td></tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No students available.</p>";
        }
    }
    ?>
</div>
</body>
</html>
