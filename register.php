<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "ghostuser";
$password = "Sakthi@2004";  // update
$dbname = "db_ghost";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $roll_number = $_POST['roll_number'];
    $department = $_POST['department'];
    $year_of_study = $_POST['year_of_study'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $contact_number = $_POST['contact_number'];

    // check duplicate roll number
    $check = $conn->prepare("SELECT id FROM sports_day WHERE roll_number = ?");
    $check->bind_param("s", $roll_number);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('❌ Roll Number already registered!'); window.location.href='http://localhost:2368/sports-day-2025/';</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO sports_day (name, roll_number, department, year_of_study, gender, dob, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $roll_number, $department, $year_of_study, $gender, $dob, $contact_number);

        if ($stmt->execute()) {
            echo "<script>alert('✅ Registration Successful!'); window.location.href='http://localhost:2368/sports-day-2025/';</script>";
        } else {
            echo "❌ Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $check->close();
}

$conn->close();
?>

