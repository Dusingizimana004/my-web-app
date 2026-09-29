<?php
session_start(); 
include('db.php');
if(!isset($_SESSION['auth'])) { header("location: index.php"); exit(); }

$msg = "";

if(isset($_POST['log_meeting'])){
    $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $m_date = mysqli_real_escape_string($conn, $_POST['m_date']);
    $f_id = intval($_POST['f_id']);
    $u_id = $_SESSION['user_id'];
    
    if(mysqli_query($conn, "INSERT INTO meetings (Purpose, Location, M_Date) VALUES ('$purpose', '$location', '$m_date')")){
        $m_id = mysqli_insert_id($conn);
        if(mysqli_query($conn, "INSERT INTO participation (M_id, F_id, user_id, Date) VALUES ($m_id, $f_id, $u_id, '$m_date')")){
            $msg = "<p style='color:var(--success); font-weight:bold;'>Attendance logged successfully.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>KAINE FC - Activity Reports</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrapper">
    <div class="left"> 
        <h3>Quick Links</h3>
        <p><a href="https://www.ferwafa.rw" target="_blank">⚽ FERWAFA</a></p>
        <p><a href="https://www.fifa.com" target="_blank">🌐 FIFA</a></p>
        <p><a href="https://www.moh.gov.rw" target="_blank">🏥 MINISANTE</a></p>
        <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
        <h3>Navigation</h3>
        <p><a href="dashboard.php">🏠 Dashboard</a></p>
        <p><a href="fans_manage.php">👥 Register Fans</a></p>
        <p><a href="weekly_report.php" style="font-weight: bold; color: var(--accent);">📊 Weekly Report</a></p>
        <p><a href="logout.php" style="color: var(--danger);">🚪 Logout</a></p>
    </div>

    <div class="middle">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h2>Weekly Fan Attendance Logs</h2>
            <button onclick="window.print()" style="padding:10px 20px; background:var(--accent); color:white; border:none; border-radius:6px; cursor:pointer; font-weight:bold;">🖨️ Print Report</button>
        </div>
        
        <?php echo $msg; ?>

        <div class="form-card" style="margin-bottom:30px;">
            <h3>Log Meeting Attendance</h3>
            <form method="POST">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <input name="purpose" placeholder="Meeting Purpose" required>
                    <input name="location" placeholder="Location" required>
                    <input name="m_date" type="date" required>
                    <select name="f_id" required style="width:100%; padding:12px; margin:10px 0; border:1px solid #ddd; border-radius:6px;">
                        <option value="">Select Attending Fan</option>
                        <?php
                        $fans = mysqli_query($conn, "SELECT * FROM fans");
                        while($f = mysqli_fetch_assoc($fans)){
                            echo "<option value='{$f['F_id']}'>{$f['F_Name']} {$f['L_Name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="log_meeting" style="margin-top:10px;">Log Attendance</button>
            </form>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Log Date</th>
                    <th>Fan Name</th>
                    <th>Meeting Purpose</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT p.Date, f.F_Name, f.L_Name, m.Purpose, m.Location 
                        FROM participation p
                        JOIN fans f ON p.F_id = f.F_id
                        JOIN meetings m ON p.M_id = m.M_id
                        ORDER BY p.Date DESC";
                $res = mysqli_query($conn, $sql);
                if(mysqli_num_rows($res) > 0){
                    while($r = mysqli_fetch_assoc($res)){
                        echo "<tr>
                                <td>{$r['Date']}</td>
                                <td>{$r['F_Name']} {$r['L_Name']}</td>
                                <td>{$r['Purpose']}</td>
                                <td>{$r['Location']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' style='text-align:center;'>No structural meeting data found for this week.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="right">
        <div style="background: #fff3cd; border-left: 6px solid #ffc107; padding: 15px; border-radius: 6px; box-shadow: var(--shadow);">
            <h4 style="color: #856404; margin-top: 0;">📢 Club Notice</h4>
            <p style="margin-bottom: 0; font-size: 14px; font-weight: bold; color: #856404;">
                CLUB Party at Muhazi Beach on 26th December 2022.
            </p>
        </div>
    </div>
</div>
</body>
</html>