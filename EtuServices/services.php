<?php
session_start();

if (!isset($_SESSION['email'])) {
    echo "Vous devez être connecté pour accéder à cette page.";
    exit;
}

echo "Bienvenue sur nos services, " . $_SESSION['email'] . "!";
echo "<br><a href='accueil.php'>Retour à l'accueil</a>";
?>
