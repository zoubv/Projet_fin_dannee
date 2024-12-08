<?php

// Inclusion du modèle pour les interactions avec la base de données
require_once('../model/UserModel.php');

// Vérification que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf_file'])) {

    // Vérification du fichier PDF
    $pdfFile = $_FILES['pdf_file'];

    if ($pdfFile['error'] === UPLOAD_ERR_OK) {
        $title = htmlspecialchars($_POST['title']);
        $description = htmlspecialchars($_POST['description']);
        
        // Vérification du type de fichier (doit être un PDF)
        $allowedTypes = ['application/pdf'];
        if (!in_array($pdfFile['type'], $allowedTypes)) {
            die("Erreur : Le fichier doit être un PDF.");
        }

        // Définir le chemin de destination
        $uploadDir = '../pdf/';
        $fileName = uniqid() . '_' . basename($pdfFile['name']);
        $filePath = $uploadDir . $fileName;

        // Déplacer le fichier téléchargé dans le répertoire de destination
        if (move_uploaded_file($pdfFile['tmp_name'], $filePath)) {
            // Sauvegarde des informations dans la base de données
            $model = new UserModel();
            $model->savePDF($title, $description, $filePath);

            // Rediriger après l'upload
            header("Location: ../view/prof_dashboard.php?message=PDF ajouté avec succès.");
            exit();
        } else {
            die("Erreur lors du téléchargement du fichier.");
        }
    } else {
        die("Veuillez sélectionner un fichier PDF.");
    }
} else {
    die("Méthode non autorisée.");
}
?>
