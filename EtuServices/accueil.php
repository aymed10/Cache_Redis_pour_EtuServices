<?php
session_start();

if (isset($_SESSION['email'])) {
    echo "Bienvenue, " . $_SESSION['email'] . "!";
    echo "<br><a href='services.php'>Accéder aux services</a>";
    echo "<br><a href='logout.php'>Se déconnecter</a>";  // Lien vers la page de déconnexion
} else {
    echo "Veuillez vous connecter.";
    echo "<br><a href='login.php'>Se connecter</a>";
}
?>
