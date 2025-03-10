<?php
$servername = "localhost";
$username = "root"; // Par défaut sous XAMPP
$password = "";
$dbname = "smarttech"; // Nom de la base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("❌ Connexion échouée : " . $conn->connect_error);
}
?>