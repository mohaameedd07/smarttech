<?php
require 'config.php';

$search = "";
$results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST['search'];
    $sql = "SELECT * FROM employes WHERE nom LIKE ? OR email LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $results = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rechercher un Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4 shadow-lg">
            <h2 class="text-center text-primary">🔍 Rechercher un Employé</h2>
            <form action="" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Entrez un nom ou un email" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-info px-4">🔎 Rechercher</button>
                    <a href="index.php" class="btn btn-secondary px-4">🔙 Retour</a>
                </div>
            </form>

            <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
                <h3 class="mt-4">Résultats :</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Document</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $results->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['nom']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td>
                                    <?php if (!empty($row['document'])) { ?>
                                        <a href="assets/uploads/<?= $row['document'] ?>" class="btn btn-info" target="_blank">📄 Voir</a>
                                    <?php } else { ?>
                                        <span class="text-danger">Aucun document</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="modifier.php?id=<?= $row['id'] ?>" class="btn btn-warning">✏ Modifier</a>
                                    <a href="supprimer.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?');">🗑 Supprimer</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</body>
</html>