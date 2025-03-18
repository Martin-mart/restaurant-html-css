<?php
require_once 'db.php'; 

// Set response type to JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields exist
    if (!isset($_POST['name'], $_POST['phone'], $_POST['person'], $_POST['reservation-date'], $_POST['reservation-time'])) {
        echo json_encode(["status" => "error", "message" => "Missing required fields."]);
        exit;
    }

    // Sanitize and collect form data
    $name = trim(htmlspecialchars($_POST['name']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $person = intval($_POST['person']); // Ensure it's an integer
    $reservation_date = trim($_POST['reservation-date']);
    $reservation_time = trim($_POST['reservation-time']);
    $message = isset($_POST['message']) ? trim(htmlspecialchars($_POST['message'])) : '';

    // Validate required fields
    if (empty($name) || empty($phone) || empty($reservation_date) || empty($reservation_time)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }

    // Prepare the SQL query
    $sql = "INSERT INTO reservations (name, phone, person, reservation_date, reservation_time, message) 
            VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $connect->prepare($sql)) {
        $stmt->bind_param("ssisss", $name, $phone, $person, $reservation_date, $reservation_time, $message);

        // Execute and check for success
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Reservation successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database error: " . $stmt->error]);
        }

        // Close statement
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Database query preparation failed."]);
    }

    // Close database connection
    $connect->close();
} else {
    // Prevent direct access
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method Not Allowed"]);
}
?>
