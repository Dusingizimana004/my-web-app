<?php
require_once __DIR__ . '/../includes/pdo.php';

class Meeting {
    private $pdo;
    private $id;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO meetings (Purpose, Location, M_Date, F_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$data['Purpose'], $data['Location'], $data['M_Date'], $data['F_id']]);
    }

    public function readAll() {
        $stmt = $this->pdo->prepare("SELECT m.*, f.F_Name, f.L_Name FROM meetings m JOIN fans f ON m.F_id = f.F_id ORDER BY m.M_id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function read() {
        if (!$this->id) return null;
        $stmt = $this->pdo->prepare("SELECT m.*, f.F_Name, f.L_Name FROM meetings m JOIN fans f ON m.F_id = f.F_id WHERE m.M_id = ?");
        $stmt->execute([$this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        if (!$this->id) return false;
        $stmt = $this->pdo->prepare("UPDATE meetings SET Purpose=?, Location=?, M_Date=?, F_id=? WHERE M_id=?");
        return $stmt->execute([$data['Purpose'], $data['Location'], $data['M_Date'], $data['F_id'], $this->id]);
    }

    public function delete() {
        if (!$this->id) return false;
        $stmt = $this->pdo->prepare("DELETE FROM meetings WHERE M_id = ?");
        return $stmt->execute([$this->id]);
    }
}
?>
