<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our caregivers</title>
    <link rel="stylesheet" href="Styles/DisplayNannies.css">
</head>
<header>
    <?php
    include_once "header.php";

    include "Classes/dbh.classes.php";
    include "Classes/profileinfo.classes.php";
    include "Classes/profileinfo.controller.php";
    include "Classes/profileinfo.view.php";
    $profileInfo = new ProfileInfoView();

    ?>
</header>
<body>
<div class="container">
    <div class="sidebar">
        <h2>Filter Nannies</h2>
        <button onclick="filterProfiles('all')">All</button>
        <button onclick="filterProfiles('part-time')">Part-Time</button>
        <button onclick="filterProfiles('full-time')">Full-Time</button>
        <button onclick="filterProfiles('live-in')">Live-In</button>
    </div>

    <!-- Main content to display profiles -->
    <div class="profiles">
        <h2>Nanny Profiles</h2>
        <div id="profile-list" class="profile-grid">
            <?php
            // Sample array of nanny profiles
            $nannies = $profileInfo->fetchAllNannies();
            // Loop through and display profiles
            foreach ($nannies as $nanny) {
                $name = $profileInfo->fetchFullName($nanny['usersId']);
                echo "<div class='profile-card' data-type='{$nanny['users_availability']}'>";
                echo "<img src='{$nanny['users_picture']}' alt='{$name}' class='profile-img'>";
                echo "<div class='profile-info'>";
               echo "<h3>{$name}</h3>";
                echo "<p>Type: {$nanny['users_availability']}</p>";
                echo "<p>Experience: {$nanny['users_experience']} years</p>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>

<script>
    function filterProfiles(type) {
        const profiles = document.querySelectorAll('.profile-card');
        profiles.forEach(profile => {
            if (type === 'all' || profile.getAttribute('data-type').toLowerCase() === type.toLowerCase()) {
                profile.style.display = 'flex';
            } else {
                profile.style.display = 'none';
            }
        });
    }
</script>
</body>
</html>
