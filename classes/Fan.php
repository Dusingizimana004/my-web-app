<?php
require_once __DIR__ . '/../includes/pdo.php';

class Fan {
    private $pdo;
    private $id;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO fans (F_Name, L_Name, Age, Sex, Telephone) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$data['F_Name'], $data['L_Name'], $data['Age'], $data['Sex'], $data['Telephone']]);
    }

    public function readAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM fans ORDER BY F_id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function read() {
        if (!$this->id) return null;
        $stmt = $this->pdo->prepare("SELECT * FROM fans WHERE F_id = ?");
        $stmt->execute([$this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        if (!$this->id) return false;
        $stmt = $this->pdo->prepare("UPDATE fans SET F_Name=?, L_Name=?, Age=?, Sex=?, Telephone=? WHERE F_id=?");
        return $stmt->execute([$data['F_Name'], $data['L_Name'], $data['Age'], $data['Sex'], $data['Telephone'], $this->id]);
    }

    public function delete() {
        if (!$this->id) return false;
        $stmt = $this->pdo->prepare("DELETE FROM fans WHERE F_id = ?");
        return $stmt->execute([$this->id]);
    }
}
?>
