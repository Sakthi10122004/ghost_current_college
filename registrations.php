<?php
$servername = "localhost";
$username = "ghostuser";
$password = "Sakthi@2004";  // change
$dbname = "db_ghost";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, roll_number, department, year_of_study, gender, dob, contact_number FROM sports_day ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registered Students</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #fff;
      color: #333;
      padding: 20px;
    }
    h2 {
      color: #e91e63;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(233, 30, 99, 0.15);
      border: 2px solid #f8bbd9;
    }
    th, td {
      border: none;
      padding: 15px 12px;
      text-align: center;
      transition: all 0.3s ease;
      font-size: 14px;
    }
    th {
      background: linear-gradient(45deg, #e91e63, #f06292);
      color: #fff;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-size: 13px;
      position: sticky;
      top: 0;
      z-index: 10;
    }
    td {
      border-bottom: 1px solid #f8bbd9;
      background: white;
    }
    tr:nth-child(even) td {
      background: #fce4ec;
    }
    tr:hover td {
      background: #f8bbd9;
      transform: scale(1.01);
      box-shadow: 0 2px 8px rgba(233, 30, 99, 0.2);
    }
    tr:nth-child(even):hover td {
      background: #f48fb1;
      color: white;
    }
    
    /* Enhanced styling for no data message */
    .no-data {
      background: linear-gradient(45deg, #fce4ec, #f8bbd9) !important;
      color: #e91e63;
      font-weight: 600;
      font-style: italic;
      padding: 30px !important;
    }
    
    /* Responsive design */
    @media (max-width: 768px) {
      table {
        font-size: 12px;
        border-radius: 10px;
      }
      th, td {
        padding: 10px 8px;
      }
      th {
        font-size: 11px;
      }
    }
    
    /* Custom scrollbar for table container */
    .table-container {
      overflow-x: auto;
      border-radius: 15px;
    }
    
    .table-container::-webkit-scrollbar {
      height: 8px;
    }
    
    .table-container::-webkit-scrollbar-track {
      background: rgba(233, 30, 99, 0.1);
      border-radius: 10px;
    }
    
    .table-container::-webkit-scrollbar-thumb {
      background: linear-gradient(45deg, #e91e63, #f06292);
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <h2>Sports Day Registrations</h2>
  <div class="table-container">
    <table>
      <tr>
        <th>Full Name</th>
        <th>Roll Number</th>
        <th>Department</th>
        <th>Year</th>
        <th>Gender</th>
        <th>DOB</th>
        <th>Contact</th>
      </tr>
      <?php
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>{$row['name']}</td>
                      <td>{$row['roll_number']}</td>
                      <td>{$row['department']}</td>
                      <td>{$row['year_of_study']}</td>
                      <td>{$row['gender']}</td>
                      <td>{$row['dob']}</td>
                      <td>{$row['contact_number']}</td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='7' class='no-data'>No registrations yet.</td></tr>";
      }
      ?>
    </table>
  </div>
</body>
</html>
<?php $conn->close(); ?>
