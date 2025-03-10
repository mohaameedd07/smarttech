<?php
include 'config.php';
$result = $conn->query("SELECT * FROM employes");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Employés</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<div class="container my-5">
    <h2 class="text-center">Liste des Employés</h2>

    <div class="card shadow-lg p-4 rounded">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Document</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['nom'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td>
                            <?php if ($row['document']) : ?>
                                <a href="assets/uploads/<?= $row['document'] ?>" target="_blank">Voir</a>
                            <?php else : ?>
                                Aucun
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="modifier.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="supprimer.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>