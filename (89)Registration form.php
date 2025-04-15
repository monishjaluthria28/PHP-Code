WAP in php to create registration form which will ask number of things like name,class,SEM,gender,mobile_no and a submit button and after submitting the details it`ll be shwon in a tabular structure.
<br>
<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "StudentDB");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Insert data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $sql = "INSERT INTO students (name, class, semester, gender, mobile_no) 
            VALUES ('{$_POST['name']}', '{$_POST['class']}', '{$_POST['sem']}', '{$_POST['gender']}', '{$_POST['mobile_no']}')";
    $conn->query($sql) ? $msg = "Record submitted successfully." : $msg = "Error: " . $conn->error;
}

// Delete data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $sql = "DELETE FROM students WHERE id={$_POST['id']}";
    $conn->query($sql) ? $msg = "Record deleted successfully." : $msg = "Error: " . $conn->error;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f8; }
        .container { max-width: 800px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 10px; }
        label, input, select { display: block; width: 100%; margin-bottom: 10px; }
        button { padding: 10px 20px; background: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background: #007BFF; color: white; }
    </style>
</head>
<body>
<div class="container">
    <h2>Registration Form</h2>
    <form method="POST" action="">
        <label>Name:</label> <input type="text" name="name" required>
        <label>Class:</label> 
        <select name="class" required>
            <option value="BCA">BCA</option>
            <option value="BBA">BBA</option>
        </select>
        <label>Semester:</label> <input type="text" name="sem" required>
        <label>Gender:</label> 
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <label>Mobile No:</label> <input type="text" name="mobile_no" required>
        <button type="submit" name="submit">Submit</button>
    </form>
    <?php if (isset($msg)) echo "<p>$msg</p>"; ?>
    
    <h2>Submitted Records</h2>
    <?php
    $result = $conn->query("SELECT * FROM students");
    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Name</th><th>Class</th><th>Semester</th><th>Gender</th><th>Mobile No</th><th>Action</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['class']}</td>
                    <td>{$row['semester']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['mobile_no']}</td>
                    <td>
                        <form method='POST' action='' style='display:inline;'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit' name='delete'>Delete</button>
                        </form>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else echo "<p>No records found.</p>";
    ?>
</div>
</body>
</html>
"This Program is written by Monish Jaluthria 0221BCA156"

