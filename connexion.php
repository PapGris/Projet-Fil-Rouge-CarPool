<?php
session_start(); 
require 'config/db.php';

if (isset($_POST['pseudoEmail']) && $_POST['pseudoEmail'] !== '' && isset($_POST['mot_de_passe']) && $_POST['mot_de_passe'] !== '') {
    $email = htmlspecialchars($_POST['pseudoEmail']);
    $password = htmlspecialchars($_POST['mot_de_passe']);


    $user = $db->prepare('SELECT * FROM utilisateur WHERE utilisateur_email = :email');
    $user->bindParam('email', $email);
    $user->execute();
    $user = $user->fetch();

    if (!$user) {
        echo 'Utilisateur non trouvé';
        exit;
    }

    // if (password_verify($password, $user['utilisateur_password'])) {
    if ($password === $user['utilisateur_mdp']) {
        session_start();
        $_SESSION['id'] = $user['utilisateur_id'];
        $_SESSION['email'] = $user['utilisateur_email'];
        $_SESSION['photo'] = $user['utilisateur_photo']; 
        header("Location: index.php");
        exit;
    } else {
        echo 'Mot de Passe incorrect';
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - Connexion</title>
    <link rel="stylesheet" href="CSS/styleInscription.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooter.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="JS/scriptInscription.js" defer></script>
    <script src="JS/script.js" defer></script>
</head>

<body>

    <div class="burger">
        <ul>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="rechercheTrajet.php">Trouver/Proposer un trajet</a></li>
        </ul>
    </div>

    <header>
        <div class="headerContainer">
            <i class="material-symbols-outlined" id="logoBurger">
                search_hands_free
            </i>

            <div class="title">
                <a href="index.php"><img class="logoCarPool" src="Images/logoCarPool.png" alt="Logo CarPool"></a>
                <h1>CarPool</h1>
            </div>
            <div class="CoDeco">
                <a href="inscription.php"><button class="btn">Inscription</button></a>
            </div>
        </div>
    </header>
    <main>

        <div class="formC-container">
            <form method="post" id="form">
                <div>
                    <label for="pseudo">Pseudo ou Email<span class="required">*</span> :</label>
                    <input type="text" id="pseudoEmail" name="pseudoEmail" required>
                </div>
                <div>
                    <label for="mot_de_passe">Mot de passe<span class="required">*</span> :</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" autocomplete="new-password" required>
                </div>

                <div>
                    <input type="submit" id="btn" value="Se connecter"><br><br>
                    <a href="mdpOublie.php"><button class="boutonMdp" type="button">Mot de passe oublié</button></a><br><br>
                    <a href="index.php"><button class="boutonAccueil" type="button">Retour à l'accueil</button></a>

                </div>
            </form>
        </div>
    </main>
    <?php include("footer.php"); ?>
</body>

</html>