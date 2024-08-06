<?php
include 'dbconnection.php';

$con = dbconnection();

// Check if 'id' is present in POST data
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $eventId = $_POST['id'];

    // Prepare DELETE statement to avoid SQL injection
    $stmt = $con->prepare("DELETE FROM events WHERE id = ?");
    $stmt->bind_param("i", $eventId);

    if ($stmt->execute()) {
        echo json_encode(array("message" => "Event deleted successfully"));
    } else {
        echo json_encode(array("error" => $stmt->error));
    }

    $stmt->close();
} else {
    echo json_encode(array("error" => "Event ID is missing"));
}

$con->close();
?>
