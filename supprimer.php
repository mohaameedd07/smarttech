<?php
include 'config.php';
$id = $_GET['id'];

$query = "DELETE FROM employes WHERE id=$id";
if ($conn->query($query) === TRUE) {
    header("Location: index.php");
} else {
    echo "Erreur : " . $conn->error;
}
?>