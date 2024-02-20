<?php
// Check if the form is submitted
if(isset($_POST['submit'])){
    // Connect to the MySQL database
    $con = mysqli_connect("localhost", "root", "", "document_generator");
    if ($con === false) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    $collegeName = $_POST['collegeName'];
    $department = $_POST['department'];
    $passingYear = $_POST['passingYear'];
    $internshipMonths = $_POST['internshipMonths'];
    $address = $_POST['address'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];

    // Insert form data into the register table
    $query = mysqli_query($con, "INSERT INTO register(firstName, lastName, contactNumber, email, collegeName, department, passingYear, internshipMonths, address, startdate, enddate) VALUES ('$firstName', '$lastName', '$contactNumber', '$email', '$collegeName', '$department', '$passingYear', '$internshipMonths', '$address', '$startdate', '$enddate')");
    
    if($query){
        // Redirect to the preview page
        header("Location: preview.php");
        exit(); // Stop executing the current script
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            display: grid;
            grid-template-columns: 1fr 1fr; /* Two-column layout */
            gap: 20px;
        }

        .section {
            display: grid;
            grid-template-rows: auto auto;
            gap: 10px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #bc2121; /* Darken the button on hover */
        }

        .result {
            margin-top: 16px;
            font-weight: bold;
            grid-column: span 2; /* Make the result span both columns */
        }

        /* Adjustments */
        #internshipMonths,
        #address {
            margin-bottom: 6px; /* Adjust the spacing between fields */
        }
    </style>
</head>
<body>

<form id="registrationForm" method="POST">
    <div class="section">
        <div>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="contactNumber">Contact Number:</label>
            <input type="tel" id="contactNumber" name="contactNumber" pattern="[0-9]{10}" required>

            <label for="email">Email ID:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="collegeName">College Name:</label>
            <input type="text" id="collegeName" name="collegeName" required>

            <label for="department">Department:</label>
            <input type="text" id="department" name="department" required>

            <label for="passingYear">Passing Out Year:</label>
            <select id="passingYear" name="passingYear" required>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
            </select>
        </div>
    </div>

    <div class="section">
        <div>
            <label for="internshipMonths">Internship Months:</label>
            <select id="internshipMonths" name="internshipMonths" required>
                <option value="3">3 Months</option>
                <option value="4">4 Months</option>
                <option value="5">5 Months</option>
                <option value="6">6 Months</option>
            </select>
        </div>

        <div>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="startdate">Start Date:</label>
            <input type="date" id="startdate" name="startdate" required>

            <label for="enddate">End Date:</label>
            <input type="date" id="enddate" name="enddate" required>

            <button type="button" onclick="calculateWeeks()">Calculate Weeks</button>
            
            <div class="result" id="weeksResult"></div>

            <button type="submit" name="submit">Submit</button>
            <button type="submit" formaction="preview.php" formmethod="get">next</button> 
        </div>
    </div>
</form>

<script>
    function calculateWeeks() {
        const startDate = new Date(document.getElementById('startdate').value);
        const endDate = new Date(document.getElementById('enddate').value);

        const timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
        const weeks = Math.ceil(timeDiff / (1000 * 3600 * 24 * 7)); // <button type="submit" name="submit">Submit</button>

        document.getElementById('weeksResult').innerText = "Number of weeks between the dates: " + weeks;
    }
</script>

</body>
</html>
