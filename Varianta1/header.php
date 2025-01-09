<?php
session_start();
?>
<link rel="stylesheet" href="Styles/index.css">

<header>
    <!-- Navigation Bar -->
    <nav>
        <div class="logo">
            <h1>Bright Care</h1>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>

            <?php
            if(isset($_SESSION['useruid']) && isset($_SESSION["userrole"])) {
                if ($_SESSION["userrole"] == "nanny") {
                    echo '<li><a href="NannyProfile.php">Profile page</a></li>';
                    echo '<li><a href="DisplayBookings.php">My Bookings</a></li>';
                    echo '<li><a href="Includes/logout.inc.php">Logout</a></li>';
                } else if ($_SESSION["userrole"] == "parent") {
                    echo '<li><a href="Booking.php">Book a caregiver</a></li>';
                    echo '<li><a href="DisplayBookings.php">My Bookings</a></li>';
                    echo '<li><a href="Includes/logout.inc.php">Logout</a></li>';
                }
            }
            else{
                echo '<li><a href="index.php#about">About</a></li>';
                echo '<li><a href="index.php#reviews">Reviews</a></li>';
                echo '<li><a href="DisplayNannies.php">Our caregivers </a></li>';
                echo '<li><a href="LogIn.php">Log In</a></li>';
                echo '<li><a href="SignUp.php">Sign Up</a></li>';

            }
            ?>

        </ul>
    </nav>
</header>