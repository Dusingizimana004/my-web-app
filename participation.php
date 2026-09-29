<?php
session_start(); include('db.php');
if(!isset($_SESSION['auth'])) header("location: index.php");

if(isset($_POST['save_p'])){
    $m_id = $_POST['m_id'];
    $f_id = $_POST['f_id'];
    $u_id = $_SESSION['user_id']; // Captured from login session
    $date = $_POST['p_date'];
    mysqli_query($conn, "INSERT INTO participation (M_id, F_id, user_id, Date) VALUES ('$m_id', '$f_id', '$u_id', '$date')");
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="middle">
        <h2>Record Fan Participation</h2>
        <form method="POST">
            <select name="m_id" required>
                <option value="">-- Select Meeting --</option>
                <?php
                $meetings = mysqli_query($conn, "SELECT * FROM meetings");
                while($m = mysqli_fetch_assoc($meetings)) echo "<option value='{$m['M_id']}'>{$m['Purpose']}</option>";
                ?>
            </select>
            <select name="f_id" required>
                <option value="">-- Select Fan --</option>
                <?php
                $fans = mysqli_query($conn, "SELECT * FROM fans");
                while($f = mysqli_fetch_assoc($fans)) echo "<option value='{$f['F_id']}'>{$f['F_Name']}</option>";
                ?>
            </select>
            <input type="date" name="p_date" required>
            <button name="save_p">Register Participation</button>
        </form>
    </div>
</body>
</html>