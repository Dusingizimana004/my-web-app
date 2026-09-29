<?php
$conn = mysqli_connect("localhost", "root", "", "kaine_fc_fans");
if (!$conn) { 
    die("Connection failed: " . mysqli_connect_error()); 
}
?>