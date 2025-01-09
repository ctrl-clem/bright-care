<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Nanny</title>
    <link rel="stylesheet" href="Styles/Booking.css">
</head>
<body>
<?php
include_once "header.php";
include "Classes/dbh.classes.php";
include "Classes/profileinfo.classes.php";
include "Classes/profileinfo.controller.php";
include "Classes/profileinfo.view.php";
$profileInfo = new ProfileInfoView();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $nannyType = $_POST['nanny_type'];
    $experience = $_POST['experience'];
    $location = $_POST['location'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $rate = $_POST['rate'];

    $nanniesByLocation = $profileInfo->getNanniesWithinReach($location);
    $nannies = $profileInfo->filterNannies($nanniesByLocation,$nannyType,$experience,$rate,$startDate,$endDate);
    $_SESSION['search_results'] = $nannies;
    $_SESSION['start_date'] = $startDate;
    $_SESSION['end_date'] = $endDate;

}
?>
<div class="container">
    <div class="booking-form">
        <h2>Book a Nanny</h2>
        <form method="POST" action="">
            <label for="nanny-type">Nanny Type:</label>
            <select name="nanny_type" id="nanny-type" required>
                <option value="full-time" <?= isset($_POST['nanny_type']) && $_POST['nanny_type'] === 'full-time' ? 'selected' : '' ?>>Full-Time</option>
                <option value="part-time" <?= isset($_POST['nanny_type']) && $_POST['nanny_type'] === 'part-time' ? 'selected' : '' ?>>Part-Time</option>
                <option value="live-in" <?= isset($_POST['nanny_type']) && $_POST['nanny_type'] === 'live-in' ? 'selected' : '' ?>>Live-In</option>
            </select>

            <label for="experience">Minimum Experience (Years):</label>
            <input type="number" name="experience" id="experience" min="1" max="20" value="<?= isset($_POST['experience']) ? htmlspecialchars($_POST['experience']) : '' ?>" required>

            <label for="location">Location (Zip Code):</label>
            <input type="text" name="location" id="location" placeholder="e.g. 10001" value="<?= isset($_POST['location']) ? htmlspecialchars($_POST['location']) : '' ?>" required>

            <label for="start-date">Start Date:</label>
            <input type="date" name="start_date" id="start-date" value="<?= isset($_POST['start_date']) ? htmlspecialchars($_POST['start_date']) : '' ?>" required>

            <label for="end-date">End Date:</label>
            <input type="date" name="end_date" id="end-date" value="<?= isset($_POST['end_date']) ? htmlspecialchars($_POST['end_date']) : '' ?>" required>

            <label for="rate">Hourly Rate (Max Budget):</label>
            <input type="number" name="rate" id="rate" min="10"  placeholder="Euros per hour" value="<?= isset($_POST['rate']) ? htmlspecialchars($_POST['rate']) : '' ?>" required>

            <button type="submit">Find Nannies</button>
        </form>
    </div>

    <div class="nanny-results">
        <h2>Available Nannies</h2>
        <div class="profile-grid">
            <?php
            if (empty($_SESSION['search_results'])) {
                echo "<p>No nannies match your criteria.</p>";
            }
            else {
                foreach ($_SESSION['search_results'] as $nanny) {

                    echo "<div class='profile-card'>";
                    echo "<img src='{$nanny['users_picture']}' alt='ceva' class='profile-img'>";
                    echo "<div class='profile-info'>";
                    echo "<h3>{$nanny['usersFirstName']} {$nanny['usersLastName']}</h3>";
                    echo "<p>Type: {$nanny['users_availability']}</p>";
                    echo "<p>Experience: {$nanny['users_experience']} years</p>";
                    echo "<p>Rate: {$nanny['users_price']} euros per hour</p>";
                    echo "</div>";
                    echo "<a href = 'NannyProfile.php?profileId={$nanny['usersId']}'> <button class='profile-btn' name='profile-btn' value = {$nanny['usersId']}>See profile</button></a>";
                    echo "</div>";

                }

            }



            ?>
        </div>
    </div>
</div>
</body>
</html>