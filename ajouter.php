<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $document = "";

    if (!empty($_FILES['document']['name'])) {
        $target_dir = "assets/uploads/";
        $document = basename($_FILES["document"]["name"]);
        move_uploaded_file($_FILES["document"]["tmp_name"], $target_dir . $document);
    }

    $sql = "INSERT INTO employes (nom, email, document) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nom, $email, $document);
    
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "❌ Erreur d'ajout : " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4 shadow-lg">
            <h2 class="text-center text-success">➕ Ajouter un Employé</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nom :</label>
                    <input type="text" class="form-control" name="nom" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email :</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Document :</label>
                    <input type="file" class="form-control" name="document">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">💾 Ajouter</button>
                    <a href="index.php" class="btn btn-secondary px-4">🔙 Annuler</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>