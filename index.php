<?php
require 'config.php';
$sql = "SELECT * FROM employes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4 shadow-lg">
            <h2 class="text-center text-primary">📋 Liste des Employés</h2>
            <a href="ajouter.php" class="btn btn-success mb-3">➕ Ajouter un employé</a>
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
                    <?php while ($row = $result->fetch_assoc()) { ?>
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
                                <a href="supprimer.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?');">🗑 Supprimer</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>