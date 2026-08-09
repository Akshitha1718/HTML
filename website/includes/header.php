<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WanderLust - Aesthetic Travel Guide</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="nav-container">
        <a href="index.php" class="logo">🌺 WanderLust</a>
        <nav>
            <ul class="nav-menu">
                <li><a href="index.php" class="nav-link <?= ($current_page == 'index.php') ? 'active' : ''; ?>">Home</a></li>
                <li><a href="destinations.php" class="nav-link <?= ($current_page == 'destinations.php') ? 'active' : ''; ?>">Destinations</a></li>
                <li><a href="guides.php" class="nav-link <?= ($current_page == 'guides.php') ? 'active' : ''; ?>">Travel Tips</a></li>
                <li><a href="gallery.php" class="nav-link <?= ($current_page == 'gallery.php') ? 'active' : ''; ?>">Gallery</a></li>
                <li><a href="contact.php" class="nav-link <?= ($current_page == 'contact.php') ? 'active' : ''; ?>">Plan Trip</a></li>
            </ul>
        </nav>
    </div>
</header>