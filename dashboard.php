<?php session_start(); if(!isset($_SESSION['auth'])) header("location: index.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>KAINE FC - Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include('includes/sidebar.php'); ?>

<div class="main-content">
    <div class="column">
        <div class="card">
            <h3>External Links</h3>
            <a href="https://www.ferwafa.rw" target="_blank" class="btn-link">⚽ FERWAFA</a>
            <a href="https://www.fifa.com" target="_blank" class="btn-link">🌐 FIFA</a>
            <a href="https://www.moh.gov.rw" target="_blank" class="btn-link">🏥 MINISANTE</a>
        </div>
        <img src="images/gettyimages-1248386395-612x612.jpg" class="card" style="width:100%; padding:0;">
    </div>

    <div class="column">
        <div class="card">
            <img src="images/gettyimages-2177221364-612x612.jpg" style="width: 100%; border-radius: 10px;">
        </div>
        
        <div class="card">
            <h3>Club Administration</h3>
            <p><strong>President:</strong> DUSINGIZIMANA ERIC</p>
            <p><strong>Manager:</strong> NTIVUGURUZWA ELIE</p>
            <p><strong>Secretary:</strong> IHIRWE PATRICK</p>
        </div>
    </div>

    <div class="column">
        <div class="card">
            <h3>Announcement</h3>
            <p style="background: #fff8e1; padding: 10px; border-left: 4px solid #ffc107;">
                <b>CLUB Party!</b><br>Join us at Muhazi beach on 26th December 2026.
            </p>
        </div>
        <img src="images/MUHAZI.jpg" class="card" style="width:100%; padding:0;">
    </div>
</div>

</body>
</html>