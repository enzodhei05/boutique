<?php
session_start();

// Vos informations de connexion à la base de données
$serveur = "localhost";
$utilisateur = "votre_utilisateur";
$mot_de_passe = "votre_mot_de_passe";
$base_de_donnees = "votre_base_de_donnees";

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Erreur de connexion à la base de données : " . $connexion->connect_error);
}

// Récupérer les données du formulaire
$username = $_POST['username'];
$password = $_POST['password'];

// Éviter les attaques par injection SQL
$username = stripslashes($username);
$password = stripslashes($password);
$username = $connexion->real_escape_string($username);
$password = $connexion->real_escape_string($password);

// Requête SQL pour insérer les informations d'inscription dans la base de données
$sql = "INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe) VALUES ('$username', '$password')";

if ($connexion->query($sql) === TRUE) {
    // Rediriger l'utilisateur vers la page de connexion après l'inscription réussie
    header("location: login.php");
} else {
    // Informer l'utilisateur en cas d'erreur lors de l'inscription
    echo "Erreur lors de l'inscription : " . $connexion->error;
}

$connexion->close();
