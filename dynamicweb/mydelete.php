<?php
include 'config.php';
include 'myheader.html';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $id = $_POST["delete_id"];

    $sql = "DELETE FROM student WHERE stdid=$id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Student deleted successfully");</script>';
    } else {
        echo "Error deleting student: " . $conn->error;
    }
}

$result = $conn->query("SELECT * FROM student");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <link href="mystyle.css" rel="stylesheet"/>
    <script>
        function confirmDelete(id) {
            return confirm("Are you sure you want to delete student with ID " + id + "?");
        }
    </script>
</head>
<body>
    <h2>Delete Student</h2>

    <table align='center' border='border' width='600' cellpadding='10'>
        <caption><b>List of Students </b></caption><br/>
        <tr>
            <th>Student Id</th>
            <th width='250'>Student Name</th>
            <th width='250'>Batch</th>
            <th width='50'>Branch</th>
            <th width='50'>Age</th>
            <th width='50'>Action</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["stdid"] . "</td>";
            echo "<td>" . $row["stdname"] . "</td>";
            echo "<td>" . $row["batch"] . "</td>";
            echo "<td>" . $row["branch"] . "</td>";
            echo "<td>" . $row["age"] . "</td>";
            echo "<td>
                    <form action='mydelete.php' method='post'>
                        <input type='hidden' name='delete_id' value='" . $row["stdid"] . "' />
                        <input type='submit' value='Delete' onclick='return confirmDelete(" . $row["stdid"] . ")' />
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
