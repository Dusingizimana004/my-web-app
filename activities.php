<?php
session_start(); include('db.php');
if(!isset($_SESSION['auth'])) header("location: index.php");

if(isset($_POST['add_mtg'])){
    $p = $_POST['purp']; $d = $_POST['dt'];
    mysqli_query($conn, "INSERT INTO Meetings (Purpose, M_Date) VALUES ('$p', '$d')");
}

if(isset($_POST['add_part'])){
    $m = $_POST['m_id']; $f = $_POST['f_id'];
    mysqli_query($conn, "INSERT INTO Participation (M_id, F_id) VALUES ('$m', '$f')");
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="middle" style="margin: auto; width: 80%;">
        <h2>Club Activities & Attendance</h2>
        <div style="display: flex; gap: 20px;">
            <form method="POST" class="form-card" style="flex: 1;">
                <h3>Create Meeting</h3>
                <input name="purp" placeholder="Meeting Purpose" required>
                <input name="dt" type="date" required>
                <button name="add_mtg">Save Meeting</button>
            </form>
            <form method="POST" class="form-card" style="flex: 1;">
                <h3>Record Attendance</h3>
                <select name="m_id" required>
                    <option value="">-- Select Meeting --</option>
                    <?php 
                    $ms = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Meetings"));
                    foreach(mysqli_query($conn, "SELECT * FROM Meetings") as $m) echo "<option value='{$m['M_id']}'>{$m['Purpose']}</option>";
                    ?>
                </select>
                <select name="f_id" required>
                    <option value="">-- Select Fan --</option>
                    <?php 
                    foreach(mysqli_query($conn, "SELECT * FROM Fans") as $f) echo "<option value='{$f['F_id']}'>{$f['F_Name']}</option>";
                    ?>
                </select>
                <button name="add_part">Record Attendance</button>
            </form>
        </div>
        <br><a href="dashboard.php" class="btn-back">← Back</a>
    </div>
</body>
</html>