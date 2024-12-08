<?php

class UserModel {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=MediaOrientation;charset=utf8', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    // Méthode pour sauvegarder un fichier PDF
    public function savePDF($title, $description, $filePath) {
        $stmt = $this->pdo->prepare('INSERT INTO fichiers_pdf (titre, description, chemin_fichier) VALUES (?, ?, ?)');
        $stmt->execute([$title, $description, $filePath]);
    }

    // Méthode pour récupérer tous les fichiers PDF
    public function getAllPDFs() {
        $stmt = $this->pdo->query('SELECT * FROM fichiers_pdf ORDER BY id DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
