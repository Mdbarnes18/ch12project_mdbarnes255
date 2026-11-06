<?php
// Author: Michael Barnes
// Date: November 6, 2026

// Database connection settings for DDEV.
$host = 'db';
$username = 'db';
$password = 'db';
$database = 'taus_data';

// Connect to the database.
$conn = mysqli_connect($host, $username, $password, $database);

// Check whether the database connection succeeded.
if (!$conn) {
    die("Database connection failed. Please try again later.");
}

$message = '';
$messageType = 'error';

// Process only submitted POST requests.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve and sanitize the submitted email address.
    $email = trim($_POST['email'] ?? '');
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Validate the email address before querying the database.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';
    } else {

        // Use a prepared statement to safely search for the email.
        $sql = "SELECT firstName, lastName, email
                FROM tbl_student
                WHERE email = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if (!$stmt) {
            $message = 'The database query could not be prepared.';
        } else {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            $student = mysqli_fetch_assoc($result);

            if ($student) {
                $fullName = htmlspecialchars(
                    $student['firstName'] . ' ' . $student['lastName']
                );
                $studentEmail = htmlspecialchars($student['email']);

                $message = "Student found: {$fullName} ({$studentEmail})";
                $messageType = 'success';
            } else {
                $message = 'No student was found with that email address.';
            }

            mysqli_stmt_close($stmt);
        }
    }
} else {
    $message = 'Please submit the search form first.';
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <main class="container">
        <h1>Search Results</h1>

        <div class="message <?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>

        <a class="back-link" href="index.php">Return to Search</a>
    </main>
</body>
</html>
