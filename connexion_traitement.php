<?php

error_reporting(E_ALL);

session_start(); // Démarrer la session

// Connexion à la base de données
$servername = "163.172.211.49"; // Adresse du serveur MySQL
$username = "enzo"; // Nom d'utilisateur MySQL
$password = "plop"; // Mot de passe MySQL
$dbname = "enzo"; // Nom de la base de données

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête SQL pour sélectionner l'utilisateur avec l'e-mail donné
    $sql = "SELECT * FROM utilisateurs WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Utilisateur trouvé, vérifier le mot de passe
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Mot de passe correct, créer une session et rediriger vers la page d'accueil par exemple
            $_SESSION['user_id'] = $row['id'];
            header("Location: index.php");
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet e-mail.";
    }
}

$conn->close();
