<?php
// Author: Michael Barnes
// Date: November 6, 2026
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searching a Database with PHP and MySQL</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <main class="container">
        <h1>Searching a Database with PHP and MySQL</h1>
        <p>Created by: Michael Barnes</p>
        <p>Date: November 6, 2026</p>

        <section class="search-panel">
            <h2>Find a Student</h2>
            <p>Enter a student's email address to search the database.</p>

            <form action="results.php" method="POST">
                <label for="email">Student Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="student@example.com"
                    required
                >
                <input type="submit" value="Search">
            </form>
        </section>
    </main>
</body>
</html>
