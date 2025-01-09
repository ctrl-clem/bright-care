<?php
session_start();
include "../Classes/dbh.classes.php";
include "../Classes/profileinfo.classes.php";
include "../Classes/profileinfo.controller.php";

header('Content-Type: application/json');

if ($_SESSION['userrole'] !== 'parent') {
    http_response_code(403);
    echo json_encode(["status" => "error", "message" => "Only parents can submit reviews."]);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['review']) || !isset($data['bookingId'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid input."]);
    exit();
}



try {
    $review = $data['review'];
    $bookingId = $data['bookingId'];
    $profileInfo = new ProfileInfoController($_SESSION['userid'],$_SESSION['useruid'],"parent");
    $result = $profileInfo->addReview($review, $bookingId);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Review submitted successfully!"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Failed to save the review."]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
