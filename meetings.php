<?php
session_start(); include('db.php');
if(!isset($_SESSION['auth'])) header("location: index.php");

if(isset($_POST['save_meeting'])){
    $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
    $m_date = $_POST['m_date'];
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $f_id = $_POST['f_id'];
    mysqli_query($conn, "INSERT INTO meetings (Purpose, M_Date, Location, F_id) VALUES ('$purpose', '$m_date', '$location', '$f_id')");
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="middle" style="margin: auto; width: 85%;">
        <h2>Record Meeting</h2>
        <form method="POST">
            <input type="text" name="purpose" placeholder="Purpose" required>
            <input type="date" name="m_date" required>
            <input type="text" name="location" placeholder="Location" required>
            <select name="f_id" required>
                <option value="">-- Select Member --</option>
                <?php
                $fans = mysqli_query($conn, "SELECT * FROM fans");
                while($f = mysqli_fetch_assoc($fans)) echo "<option value='{$f['F_id']}'>{$f['F_Name']} {$f['L_Name']}</option>";
                ?>
            </select>
            <button type="submit" name="save_meeting">Save Meeting</button>
        </form>
        <table>
            <tr><th>Date</th><th>Purpose</th><th>Member</th></tr>
            <?php
            $res = mysqli_query($conn, "SELECT meetings.*, fans.F_Name FROM meetings JOIN fans ON meetings.F_id = fans.F_id");
            while($row = mysqli_fetch_assoc($res)) echo "<tr><td>{$row['M_Date']}</td><td>{$row['Purpose']}</td><td>{$row['F_Name']}</td></tr>";
            ?>
        </table>
        <br><a href="dashboard.php">← Back</a>
    </div>
</body>
</html>