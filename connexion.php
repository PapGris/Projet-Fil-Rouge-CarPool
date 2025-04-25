<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';

$errors = [
    'pseudoEmail' => '',
    'mot_de_passe' => ''
];

if (!empty($_POST['pseudoEmail']) && !empty($_POST['mot_de_passe'])) {
    $input = htmlspecialchars($_POST['pseudoEmail']);
    $password = $_POST['mot_de_passe'];

    $stmt = $db->prepare('SELECT * FROM utilisateur WHERE utilisateur_email = :input OR utilisateur_pseudo = :input');
    $stmt->bindParam(':input', $input);
    $stmt->execute();
    $user = $stmt->fetch();

    if (!$user) {
        $errors['pseudoEmail'] = 'Aucun utilisateur trouvé avec cet email ou pseudo.';
    } elseif (!password_verify($password, $user['utilisateur_mdp'])) {
        $errors['mot_de_passe'] = 'Mot de passe incorrect.';
    } else {
        $_SESSION['id'] = $user['utilisateur_id'];
        $_SESSION['email'] = $user['utilisateur_email'];
        $_SESSION['photo'] = $user['utilisateur_photo'];
        header("Location: index.php");
        exit;
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

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
    ?>

    <main>

        <div class="formC-container">
            <form method="post" id="form">
                <div>
                    <label for="pseudoEmail">Pseudo ou Email<span class="required">*</span> :</label>
                    <input type="text" id="pseudoEmail" name="pseudoEmail" required value="<?= htmlspecialchars($_POST['pseudoEmail'] ?? '') ?>">
                    <?php if (!empty($errors['pseudoEmail'])): ?>
                        <div class="error"><?= $errors['pseudoEmail'] ?></div>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="mot_de_passe">Mot de passe<span class="required">*</span> :</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                    <?php if (!empty($errors['mot_de_passe'])): ?>
                        <div class="error"><?= $errors['mot_de_passe'] ?></div>
                    <?php endif; ?>
                </div><br>

                <div>
                    <input type="submit" id="btn" value="Se connecter"><br><br>
                    <a href="mdpOublie.php"><button class="boutonMdp" type="button">Mot de passe oublié</button></a><br><br>
                    <a href="index.php"><button class="boutonAccueil" type="button">Retour à l'accueil</button></a>
                </div>
            </form>
        </div>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
</body>

</html>