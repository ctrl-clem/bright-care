<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nanny Questionnaire</title>
    <link rel="stylesheet" href="Styles/QuestionnareNanny.css">
</head>
<body>
<?
include_once "header.php";
?>
<div class="form-container">
    <h1>Nanny Questionnaire</h1>
    <form method="post" action="Classes/saveNannyInfo.inc.php">
        <!-- Years of experience -->
        <div class="form-group">
            <label for="experience">How many years of experience do you have?</label>
            <input type="number" id="experience" name="experience" placeholder="Enter years" required>
        </div>

        <!-- Type of job -->
        <div class="form-group">
            <label for="job-type">What type of job do you prefer?</label>
            <select id="job-type" name="job-type" required>
                <option value="part-time">Part-Time</option>
                <option value="full-time">Full-Time</option>
                <option value="live-in">Live-In</option>
                <option value="any-type">Any Type</option>
            </select>
        </div>

        <!-- Hourly rate -->
        <div class="form-group">
            <label for="hourly-rate">What is your hourly rate?</label>
            <input type="number" id="hourly-rate" name="hourly-rate" min="0" placeholder="Enter rate in Euros" required>
        </div>

        <!-- Submit button -->
        <div class="form-group">
            <button type="submit" class="submit-btn">Submit</button>
        </div>
    </form>
</div>
</body>
</html>
