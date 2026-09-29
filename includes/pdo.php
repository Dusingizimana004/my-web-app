<?php
$host = 'localhost';
$dbname = 'kaine_fc_fans';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Procedural PDO CRUD functions for fans
function createFanPDO($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO fans (F_Name, L_Name, Age, Sex, Telephone) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$data['F_Name'], $data['L_Name'], $data['Age'], $data['Sex'], $data['Telephone']]);
}

function readFansPDO($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM fans ORDER BY F_id DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateFanPDO($pdo, $id, $data) {
    $stmt = $pdo->prepare("UPDATE fans SET F_Name=?, L_Name=?, Age=?, Sex=?, Telephone=? WHERE F_id=?");
    return $stmt->execute([$data['F_Name'], $data['L_Name'], $data['Age'], $data['Sex'], $data['Telephone'], $id]);
}

function deleteFanPDO($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM fans WHERE F_id = ?");
    return $stmt->execute([$id]);
}
?>
