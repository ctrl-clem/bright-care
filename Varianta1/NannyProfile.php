<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="Styles/NannyProfile.css">
</head>
<?php
include_once "header.php";

include "Classes/dbh.classes.php";
include "Classes/profileinfo.classes.php";
include "Classes/profileinfo.controller.php";
include "Classes/profileinfo.view.php";
$profileInfo = new ProfileInfoView();
if($_SESSION["userrole"] == "nanny")
    $profileId = $_SESSION["userid"];
else
    $profileId = $_GET["profileId"];

$picture = $profileInfo->fetchPicture($profileId);

$reviews = $profileInfo->fetchReviews($profileId);

?>
<body>
<div class="profile-container">
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-image">
                <img src="<?= htmlspecialchars(isset($picture) ? $picture : 'default-avatar.jpg') ?>" alt="Profile picture">

                <?php if($_SESSION["userrole"] == "nanny"):?>
                <form method="POST" action="Classes/updatePicture.inc.php" enctype="multipart/form-data">
                    <input type="hidden" name="nanny_id" value="<?= htmlspecialchars($profileId) ?>">
                    <label for="profile_picture_<?= $profileId ?>" class="file-label">
                        Update Picture
                        <input
                                type="file"
                                name="profile_picture"
                                id="profile_picture_<?= $profileId ?>"
                                onchange="this.form.submit()"
                                required>
                    </label>
                </form>
                <?php endif;?>

        </div>
            <div class="profile-name">
                <h1>
                    <?php
                    echo $profileInfo->fetchFullName($profileId);
                    ?>
                </h1>
                <h2><?php
                        $type= $profileInfo->fetchType($profileId);
                    $type = strtoupper($type) . " NANNY";
                    echo $type;
                    echo "</h2>";
                    echo "<h2>Price per hour: " . $profileInfo->fetchPrice($profileId) . " euros";
                    ?></h2>
                <?php if($_SESSION["userrole"] == "nanny"):?>
                    <a href="./ProfileSettings.php" class="button">Profile Settings</a>

                <?php endif;?>
                <?php if($_SESSION["userrole"] == "parent"):?>
                    <button class="button" onclick="openPopup()">Book <?php echo $profileInfo->fetchFullName($profileId)?></button>
                <?php endif;?>
            </div>

        </div>

        <div class="profile-content">
            <div class="bio-section section">
                <h3>About:</h3>
                <p>
                    <?php
                    echo $profileInfo->fetchAbout($profileId);
                    ?>
                </p>
            </div>

            <div class="skills-section section">
                <h3>Skills:</h3>
                <?php
                echo $profileInfo->fetchSkills($profileId);
                ?>
            </div>

            <div class="mini-cv-section section">
                <h3>Mini-CV:</h3>
                <?php
                echo $profileInfo->fetchCV($profileId);
                ?>
            </div>

            <?php if($reviews):?>
            <div class="reviews-section section">
                <h3>Reviews:</h3>
                <?php
                    foreach($reviews as $review){
                        echo '<div class="review">';
                        echo '<p>';
                        echo $review['usersFirstName'] . ' ' .$review['usersLastName'] . ': ' . $review['review'];
                        echo '</p></div>';
                    }
                ?>
            </div>
            <?php endif;?>


            <div class="contact-info section">
                <h3>Contact info:</h3>
                <ul class="contact-list">
                    <li><strong>Phone:</strong> <?php
                        echo $profileInfo->fetchPhoneNumber($profileId);
                        ?></li>
                    <li><strong>Email:</strong><?php
                        echo $profileInfo->fetchEmail($profileId);
                        ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="popup" class="popup-container">
    <div class="popup">
        <h2>Booking Details</h2>
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" class="popup-input" value="<?= isset($_SESSION['start_date']) ? htmlspecialchars($_SESSION['start_date']) : '' ?>" readonly/>

        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" class="popup-input" value="<?= isset($_SESSION['end_date']) ? htmlspecialchars($_SESSION['end_date']) : '' ?>" readonly />

        <div class="popup-buttons">
            <button class="popup-button confirm" onclick="confirmBooking()">Confirm</button>
            <button class="popup-button cancel" onclick="closePopup()">Cancel</button>
        </div>
    </div>
</div>
<script>

    function openPopup() {
        document.getElementById('popup').style.display = 'flex';
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }

    function confirmBooking() {

        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        if (startDate && endDate) {
            <?php
            if($_SESSION["userrole"] == "parent")
                $profileInfo->addBooking($_SESSION["userid"], $profileId, $_SESSION["start_date"], $_SESSION["end_date"]);
            ?>
            alert(`Booking confirmed from ${startDate} to ${endDate}!`);
            closePopup();
        }
    }
</script>
</body>

</html>
