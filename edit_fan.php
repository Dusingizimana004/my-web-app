<?php
session_start(); include('db.php');
if(!isset($_SESSION['auth'])) header("location: index.php");

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM Fans WHERE F_id=$id");
$row = mysqli_fetch_assoc($res);

if(isset($_POST['update'])){
    $fn = $_POST['fn']; $ln = $_POST['ln']; $ag = $_POST['ag']; 
    $sx = $_POST['sx']; $tl = $_POST['tl'];
    mysqli_query($conn, "UPDATE Fans SET F_Name='$fn', L_Name='$ln', Age='$ag', Sex='$sx', Telephone='$tl' WHERE F_id=$id");
    header("location: fans_manage.php");
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="middle" style="margin: auto; width: 50%;">
        <h2>Update Fan Details</h2>
        <form method="POST" class="form-card">
            <input name="fn" value="<?php echo $row['F_Name']; ?>" required>
            <input name="ln" value="<?php echo $row['L_Name']; ?>" required>
            <input name="ag" value="<?php echo $row['Age']; ?>" type="number">
            <input name="sx" value="<?php echo $row['Sex']; ?>">
            <input name="tl" value="<?php echo $row['Telephone']; ?>">
            <button name="update">Update Record</button>
            <a href="fans_manage.php" style="display:block; margin-top:10px; text-align:center;">Cancel</a>
        </form>
    </div>
</body>
</html>