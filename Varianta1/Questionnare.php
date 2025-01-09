<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Babysitter Needs Questionnaire</title>
    <link rel="stylesheet" href="Styles/Questionnare.css">
</head>
<body>
<div class="container">
    <h1>Babysitter Needs Questionnaire</h1>
    <form action="Classes/profileinfo.inc.php" method="POST">
        <!-- Question 1 -->
        <div class="question-box">
            <div class="question">
                <p>1. What is the most important factor when choosing a babysitter?</p>
                <label class="radio-container">Experience
                    <input type="radio" name="factor" value="Experience">
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">Availability
                    <input type="radio" name="factor" value="Availability">
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">Cost
                    <input type="radio" name="factor" value="Cost">
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">References
                    <input type="radio" name="factor" value="References">
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">Personality
                    <input type="radio" name="factor" value="Personality">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>

        <!-- Question 2 -->
        <div class="question-box">
            <div class="question">
                <p>2. How often do you need babysitting services?</p>
                <label class="radio-container">Daily
                    <input type="radio" name="frequency" value="Daily">
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">Weekly
                    <input type="radio" name="frequency" value="Weekly">
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">Occasionally
                    <input type="radio" name="frequency" value="Occasionally">
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">Other
                    <input type="radio" name="frequency" value="Other">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>

        <!-- Question 3 -->
        <div class="question-box">
            <div class="question">
                <p>3. How many children do you have that will require babysitting?</p>
                <label class="radio-container">1
                    <input type="radio" name="children" value="1">
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">2
                    <input type="radio" name="children" value="2">
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">3
                    <input type="radio" name="children" value="3">
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">More than 3
                    <input type="radio" name="children" value="More than 3">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>

        <!-- Question 4 -->
        <div class="question-box">
            <div class="question">
                <p>4. What age group are your children in? (Select all that apply)</p>
                <label class="checkbox-container">0-2 years
                    <input type="checkbox" name="ageGroup[]" value="0-2">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">3-5 years
                    <input type="checkbox" name="ageGroup[]" value="3-5">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">6-9 years
                    <input type="checkbox" name="ageGroup[]" value="6-9">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">10+ years
                    <input type="checkbox" name="ageGroup[]" value="10+">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>

        <!-- Question 5 -->
        <div class="question-box">
            <div class="question">
                <p>5. What specific qualifications or certifications do you look for in a babysitter?</p>
                <label class="checkbox-container">CPR Certified
                    <input type="checkbox" name="qualifications[]" value="CPR Certified">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">First Aid Training
                    <input type="checkbox" name="qualifications[]" value="First Aid Training">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Childcare Certification
                    <input type="checkbox" name="qualifications[]" value="Childcare Certification">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Background Check
                    <input type="checkbox" name="qualifications[]" value="Background Check">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Early Childhood Education
                    <input type="checkbox" name="qualifications[]" value="Early Childhood Education">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>

        <!-- Question 6 -->
        <div class="question-box">
            <div class="question">
                <p>6. Do you have any additional preferences or requirements?</p>
                <textarea name="preferences" rows="4" placeholder="Describe any additional requirements or preferences..."></textarea>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="submit-button">
            <button type="submit" name="submit">Submit</button>
        </div>
    </form>
</div>
</body>
</html>
