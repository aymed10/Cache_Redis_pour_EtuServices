<?php
session_start();

if (isset($_SESSION['email'])) {
    echo "Bienvenue, " . $_SESSION['email'] . "!";
    echo "<br><a href='accueil.php'>Accéder à l'accueil</a>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new SQLite3(__DIR__ . '/../db/etuservices.db');

    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $query = "SELECT * FROM utilisateurs WHERE email = :email AND mot_de_passe = :mot_de_passe";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':mot_de_passe', $mot_de_passe, SQLITE3_TEXT);
    $result = $stmt->execute();

    if ($row = $result->fetchArray()) {
        $cmd = escapeshellcmd("python3 ../redis_cli/redis_manager.py $email");
        $output = shell_exec($cmd);
        
        if (strpos($output, "peut se connecter") !== false) {
            $_SESSION['email'] = $email;
            echo "Connexion réussie, bienvenue $email!";
            echo "<br><a href='accueil.php'>Accéder à l'accueil</a>";
        } else {
            echo "Vous avez dépassé le quota de connexions.";
        }
    } else {
        echo "Identifiants incorrects.";
    }
} else {
    echo '
    <h2>Connexion</h2>
    <form method="POST" action="login.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="mot_de_passe">Mot de passe:</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>
        
        <input type="submit" value="Se connecter">
    </form>
    ';
}
?>
