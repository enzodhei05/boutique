<?php
// Démarrer la session
session_start();

// Vérifier le token anti-CSRF
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    // Récupérer et nettoyer les données soumises par le formulaire
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hachage du mot de passe

    // Connexion à la base de données (à remplir avec vos informations de connexion)
    $servername = "163.172.211.49";
    $username_db = "enzo";
    $password_db = "plop";
    $dbname = "enzo";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Requête SQL pour insérer l'utilisateur dans la table utilisateurs
    $sql = "INSERT INTO utilisateurs (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur lors de l'inscription : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $stmt->close();
    $conn->close();
} else {
    echo "Erreur : tentative de soumission de formulaire non autorisée.";
}
