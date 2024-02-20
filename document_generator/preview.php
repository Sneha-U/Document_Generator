<?php
// Connect to the MySQL database
$con = mysqli_connect("localhost", "root", "", "document_generator");
if ($con === false) {
    die("Connection Failed: " . mysqli_connect_error());
}

// Fetch the last row from the register table based on the created_at timestamp
$query = "SELECT * FROM register ORDER BY Id DESC LIMIT 1";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die("Query Failed: " . mysqli_error($con));
}

// Fetch the row from the result set
$row = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Internship Offer Preview</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    .container {
      max-width: 600px;
      margin: auto;
    }
    h1, h2 {
      text-align: center;
    }
    address {
      margin-top: 20px;
    }
    p {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Internship Offer</h1>
    <p><strong>Ref No:</strong> iL/SEI/005</p>
    <p><strong>Date:</strong> <?php echo date('jS F Y'); ?></p>
    <address>
      <?php echo htmlspecialchars($row['firstName']) . ' ' . htmlspecialchars($row['lastName']); ?><br>
      <?php echo htmlspecialchars($row['address']); ?>
    </address>
    <p>Dear <?php echo htmlspecialchars($row['firstName']) . ' ' . htmlspecialchars($row['lastName']); ?>,</p>
    <p>We are pleased to offer you an internship at Influencer Labs Pvt Ltd, Bangalore office.</p>
    <p><strong>Compensation:</strong> Your stipend will be INR 5000 per month.</p>
    <p><strong>Date of reporting:</strong> Your date of reporting at Influencer Labs will be <?php echo htmlspecialchars($row['startdate']); ?>. In the event of your failing to do so, the offer made herein shall stand withdrawn unless the reporting date is extended and communicated to you in writing by the Company. In case you need to extend your joining date please communicate the same to us.</p>
    <p>You are required to report to the Human Resources Department to complete your joining formalities.</p>
    <p>Please note that the terms of this offer are strictly confidential between you and the Company.</p>
    <p><strong>Hours of Work:</strong> The Company observes a 5-workdays/week with working hours between: 10.00 AM to 6.30 PM. There will be a 45-minute lunch break. The Company reserves the right, if it reasonably requires, to increase, reduce, and/or otherwise vary or alter your hours or times of work.</p>
    <p><strong>Period of Internship:</strong> The duration of your internship with Influencer Labs is <?php echo htmlspecialchars($row['startdate']); ?> to <?php echo htmlspecialchars($row['enddate']); ?>.</p>
    <p><strong>Conveyance, stay, etc.:</strong> You will make at your cost your arrangements for a stay in Bangalore and travel to and from the office to your place of stay.</p>
    <p><strong>Leave:</strong> One day per month till the end of your internship.</p>
    <p><strong>Presentation on Completion of Internship:</strong> You will be expected to prepare a report and make a presentation of your learning and contribution.</p>
    <p><strong>Certificate of Successful Completion of Internship:</strong> Will be provided by Influencer Labs.</p>
    <p><strong>Termination:</strong> The Company retains the right to terminate the internship without giving notice, on the grounds of misconduct or behavior inconsistent with the fulfillment of the expressed or implied conditions of service. The Company reserves the right to recover any outstanding sums from the stipend money payable to you.</p>
    <p><strong>Non-Compete:</strong> During your training / Internship period with Influencer Labs, you shall not directly or indirectly, run, operate, control, be employed by, or provide any services to any competitor of the Company. You shall under no circumstances work for or operate a business competing against the Company, that is, any business, trade, or occupation that is engaged in the Audio, Infotainment, and Navigation business including all related software engineering and development business in India.</p>
    <p>All Interns are expected to maintain the highest level of ethical conduct and are required to sign our Code of Ethics acknowledgment certificate.</p>

    <!-- Form to submit internship offer details to the email -->
    <form action="send_mail.php" method="post">
    <input type="submit" value="Send Internship Offer to Email">
    </form>

    <!-- Button to trigger print functionality -->
    <button onclick="window.print()">Print</button>
  
  </div>
</body>
</html>
