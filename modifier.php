<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employes WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $employe = $result->fetch_assoc();
} else {
    die("❌ ID Employé non fourni !");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $document = $employe['document'];

    if (!empty($_FILES['document']['name'])) {
        $target_dir = "assets/uploads/";
        $document = basename($_FILES["document"]["name"]);
        move_uploaded_file($_FILES["document"]["tmp_name"], $target_dir . $document);
    }

    $sql = "UPDATE employes SET nom=?, email=?, document=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nom, $email, $document, $id);
    
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "❌ Erreur de modification : " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4 shadow-lg">
            <h2 class="text-center text-warning">✏ Modifier un Employé</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nom :</label>
                    <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($employe['nom']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email :</label>
                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($employe['email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Document :</label>
                    <input type="file" class="form-control" name="document">
                    <p class="text-muted">Fichier actuel : <strong><?= htmlspecialchars($employe['document']) ?></strong></p>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-warning px-4">💾 Modifier</button>
                    <a href="index.php" class="btn btn-secondary px-4">🔙 Annuler</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>