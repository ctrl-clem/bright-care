<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel = stylesheet href = "Styles/DisplayBookings.css">

</head>
<body>
<?php
include_once "header.php";
include "Classes/dbh.classes.php";
include "Classes/profileinfo.classes.php";
include "Classes/profileinfo.controller.php";
include "Classes/profileinfo.view.php";

$profileinfo = new ProfileInfoView();

?>
<div class="container">
    <h2>All Bookings</h2>

    <?php
    $bookings = $profileinfo->fetchBookings($_SESSION['userid'],$_SESSION['userrole']);


    if (count($bookings) > 0) {
        foreach ($bookings as $booking) {
            echo '<div class="booking-card">';
            echo '<div class="card-header">';
            echo '<span class="label">Name:</span> ' . htmlspecialchars($booking['usersFirstName']) . " " . htmlspecialchars($booking['usersLastName']);
            echo '</div>';
            echo '<div class="card-details">';
            echo '<span><span class="label">Start:</span> ' . htmlspecialchars($booking['start_date']) . '</span>';
            echo '<span><span class="label">End:</span> ' . htmlspecialchars($booking['end_date']) . '</span>';
            echo '<span><span class="label">Email:</span> ' . htmlspecialchars($booking['usersEmail']) . '</span>';
            echo '<span><span class="label">Phone number:</span> ' . htmlspecialchars($booking['usersPhone']) . '</span>';
            echo '</div>';
            echo '<div class="card-footer">';
            if ($booking['review']) {
                echo '<div class="label">Review: ' . '<span class = "review-text">' . htmlspecialchars($booking['review']). '</span>'  . '</div>';
            } else {
                if ($_SESSION['userrole'] == "parent") {
                    echo '<button class="review-button" onclick="openReviewPopup(' . htmlspecialchars($booking['id']) . ')">Leave a Review</button>';
                }
            }
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="no-bookings">No bookings available.</div>';
    }
    ?>
    <div id="popup" class="popup-container">
        <div class="popup">
            <h3>Leave a Review</h3>
            <textarea id="reviewText" rows="4" placeholder="Write your review..."></textarea>
            <div class="popup-buttons">
                <button class="popup-button submit" onclick="submitReview()">Submit</button>
                <button class="popup-button cancel" onclick="closeReviewPopup()">Cancel</button>
            </div>
        </div>
    </div>
</div>



<script>
    let currentBookingId = null;

    function openReviewPopup(bookingId) {
        currentBookingId = bookingId;
        document.getElementById('popup').style.display = 'flex';
    }

    function closeReviewPopup() {
        currentBookingId = null;
        document.getElementById('popup').style.display = 'none';
    }

    function submitReview() {
        const reviewText = document.getElementById('reviewText').value;

        if (reviewText.trim() === '') {
            alert('Please write a review before submitting.');
            return;
        }

        fetch('Classes/submitReview.inc.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                bookingId: currentBookingId,
                review: reviewText,
            }),
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status === 'success') {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
    }

</script>
</body>
</html>
