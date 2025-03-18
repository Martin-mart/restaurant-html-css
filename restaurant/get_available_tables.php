<?php
include 'db.php'; // Ensure correct database connection

header('Content-Type: application/json');

$sql = "SELECT id, table_number FROM reservations WHERE is_booked = 0";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode(["status" => "error", "message" => "Database query failed: " . $conn->error]);
    exit;
}

$tables = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tables[] = $row;
    }
}

echo json_encode(["status" => "success", "tables" => $tables]);

$conn->close();
?>
