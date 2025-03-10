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
    <h2 class="text-center">Liste complète des Employés</h2>

    <div class="card shadow-lg p-4 rounded">
        <ul class="list-group">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= $row['nom'] ?> (<?= $row['email'] ?>)
                    <span>
                        <a href="modifier.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </span>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>

</body>
</html>