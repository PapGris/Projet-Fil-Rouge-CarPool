<div class="burger">
    <?php

    if (!isset($_SESSION['id'])) {
    ?>
        <ul>
            <li><a href="connexion.php">Connexion</a></li>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="rechercheTrajet.php">Trouver/Proposer un trajet</a></li>
        </ul>
    <?php
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/config/init.php';
    ?>
        <div class="profilePicContainer">
            <a href="profilUtilisateur.php"><img src="<?= htmlspecialchars($user['utilisateur_photo'] ?? 'Images/photoProfilParDefaut.png') ?>" alt="Photo de profil" class="profile-picMini-burger"></a>
        </div>
        <ul>
            <li><a href="covoiturage.php">Trouver/Proposer un trajet</a></li>
            <li><a href="notificationUtilisateur.php">Notifications</a></li>
            <li><a href="historiqueUtilisateur.php">Historique</a></li>
            <li><a href="modifProfil.php">Modifier mon profil</a></li>
            <li><a href="../action/logout.php">Déconnexion</a></li>
        </ul>
    <?php
    }
    ?>

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
            <?php
            if (!isset($_SESSION['id'])) {
            ?>
                <a href="connexion.php"><button class="btn">Connexion</button></a>
                <a href="inscription.php"><button class="btn">Inscription</button></a>
            <?php
            } else {
            ?>
                <div class="profile-dropdown">
                    <img src="<?= htmlspecialchars($user['utilisateur_photo'] ?? 'Images/photoProfilParDefaut.png') ?>" alt="Photo de profil" class="profile-picMini" id="profileToggle">
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="covoiturage.php">Trouver/Proposer un trajet</a>
                        <a href="notificationUtilisateur.php">Notifications</a>
                        <a href="historiqueUtilisateur.php">Historique</a>
                        <a href="modifProfil.php">Modifier mon profil</a>
                    </div>
                </div>
                <a href="profilUtilisateur.php"><button class="btn">Mon Profil</button></a>
                <a href="../action/logout.php" class="btn">Déconnexion</a>
            <?php
            }
            ?>
        </div>
    </div>
</header>