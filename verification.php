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

// Requête SQL pour vérifier les informations d'identification
$sql = "SELECT * FROM utilisateurs WHERE nom_utilisateur='$username' AND mot_de_passe='$password'";
$resultat = $connexion->query($sql);

// Vérifier si l'utilisateur existe dans la base de données
if ($resultat->num_rows == 1) {
    // L'utilisateur est authentifié avec succès
    $_SESSION['username'] = $username;
    header("location: accueil.php"); // Rediriger vers la page d'accueil après la connexion
} else {
    // Informer l'utilisateur que les informations d'identification sont incorrectes
    header("location: login.php?erreur=1");
}

$connexion->close();
