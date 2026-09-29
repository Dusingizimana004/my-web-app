<?php
session_start(); 
include('db.php');
if(!isset($_SESSION['auth'])) { header("location: index.php"); exit(); }

$msg = "";

if(isset($_POST['add'])){
    $fn = mysqli_real_escape_string($conn, $_POST['fn']); 
    $ln = mysqli_real_escape_string($conn, $_POST['ln']); 
    $ag = intval($_POST['ag']); 
    $sx = mysqli_real_escape_string($conn, $_POST['sx']); 
    $tl = mysqli_real_escape_string($conn, $_POST['tl']);
    
    if(mysqli_query($conn, "INSERT INTO fans (F_Name, L_Name, Age, Sex, Telephone) VALUES ('$fn', '$ln', $ag, '$sx', '$tl')")){
        $msg = "<p style='color:var(--success); font-weight:bold;'>Fan account saved successfully.</p>";
    }
}

if(isset($_GET['del'])){
    $id = intval($_GET['del']); 
    mysqli_query($conn, "DELETE FROM fans WHERE F_id=$id");
    header("Location: fans_manage.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>KAINE FC - Fan Management</title>
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
        <p><a href="fans_manage.php" style="font-weight: bold; color: var(--accent);">👥 Register Fans</a></p>
        <p><a href="weekly_report.php">📊 Weekly Report</a></p>
        <p><a href="logout.php" style="color: var(--danger);">🚪 Logout</a></p>
    </div>

    <div class="middle">
        <h2>Fan Management Portal</h2>
        <?php echo $msg; ?>
        
        <div class="form-card" style="margin-bottom: 30px;">
            <h3>Register New Fan Profile</h3>
            <form method="POST">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <input name="fn" placeholder="First Name" required> 
                    <input name="ln" placeholder="Last Name" required>
                    <input name="ag" placeholder="Age" type="number" required> 
                    <select name="sx" required style="width:100%; padding:12px; margin:10px 0; border:1px solid #ddd; border-radius:6px;">
                        <option value="">Select Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <input name="tl" placeholder="Phone Number" required> 
                <button type="submit" name="add" style="margin-top: 10px;">Save Fan Profile</button>
            </form>
        </div>

        <h3>Active Roster Records</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Age</th>
                    <th>Sex</th>
                    <th>Telephone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($conn, "SELECT * FROM fans");
                if(mysqli_num_rows($res) > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<tr>
                                <td>{$row['F_id']}</td>
                                <td>{$row['F_Name']} {$row['L_Name']}</td>
                                <td>{$row['Age']}</td>
                                <td>{$row['Sex']}</td>
                                <td>{$row['Telephone']}</td>
                                <td><a href='?del={$row['F_id']}' onclick=\"return confirm('Delete this fan?')\" style='color:var(--danger); font-weight:bold; text-decoration:none;'>Delete</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>No fans registered yet.</td></tr>";
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