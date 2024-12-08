<div class="container mt-5">
    <h1 class="text-primary mb-4">Tableau de Bord - Professeur</h1>

    <!-- Formulaire d'upload de PDF -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h5>Ajouter un Nouveau PDF</h5>
        </div>
        <div class="card-body">
            <form action="../controller/upload_pdf.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Titre du PDF</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="pdf_file" class="form-label">Choisir un fichier PDF</label>
                    <input type="file" name="pdf_file" id="pdf_file" class="form-control" accept=".pdf" required>
                </div>
                <button type="submit" class="btn btn-success">Télécharger</button>
            </form>
        </div>
    </div>

    <!-- Liste des PDFs déjà ajoutés -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Liste des Fichiers PDF</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('../model/UserModel.php');
                    $userModel = new UserModel();
                    $pdfs = $userModel->getAllPDFs();

                    if (!empty($pdfs)) {
                        foreach ($pdfs as $pdf) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($pdf['titre']) . '</td>';
                            echo '<td>' . htmlspecialchars($pdf['description']) . '</td>';
                            echo '<td><a href="' . htmlspecialchars($pdf['chemin_fichier']) . '" class="btn btn-info btn-sm" target="_blank">Voir</a></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="3" class="text-center">Aucun fichier PDF disponible.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
