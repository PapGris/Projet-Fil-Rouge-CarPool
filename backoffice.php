<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
session_start();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool</title>
    <link rel="stylesheet" href="CSS/styleBackoffice.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="JS/script.js" defer></script>
    <script src="JS/scriptCalendar.js" defer></script>

</head>

<body>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
    ?>

    <main>
        <div class="userContainer">
            <h2>Backoffice des utilisateurs</h2>
            <div>
                <table class="userTable">
                    <thead>
                        <tr>
                            <th>Nom Prénom</th>
                            <th>Pseudo</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Service</th>
                            <th>Lieu</th>
                            <th>Conducteur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Doe John</td>
                            <td>Papillon-Gris</td>
                            <td>johndoe@exemple.com</td>
                            <td>06 25 54 43 61</td>
                            <td>Développement Web</td>
                            <td>Paris, France</td>
                            <td>Oui</td>
                            <td>
                                <div class="btn-container">
                                    <button class="btn-modifier">Modifier</button>
                                    <button class="btn-supprimer">Supprimer</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Martin Sophie</td>
                            <td>Codeuse87</td>
                            <td>sophiem@exemple.com</td>
                            <td>06 12 34 56 78</td>
                            <td>Design UI/UX</td>
                            <td>Lyon, France</td>
                            <td>Non</td>
                            <td>
                                <div class="btn-container">
                                    <button class="btn-modifier">Modifier</button>
                                    <button class="btn-supprimer">Supprimer</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Durand Pierre</td>
                            <td>DevMaster</td>
                            <td>pierred@exemple.com</td>
                            <td>06 98 76 54 32</td>
                            <td>Développement Backend</td>
                            <td>Marseille, France</td>
                            <td>Oui</td>
                            <td>
                                <div class="btn-container">
                                    <button class="btn-modifier">Modifier</button>
                                    <button class="btn-supprimer">Supprimer</button>
                                </div>
                            </td>
                        <tr>
                            <td>Lefevre Clara</td>
                            <td>ClaraTech</td>
                            <td>claral@exemple.com</td>
                            <td>07 88 99 66 55</td>
                            <td>Marketing Digital</td>
                            <td>Bordeaux, France</td>
                            <td>Non</td>
                            <td>
                                <div class="btn-container">
                                    <button class="btn-modifier">Modifier</button>
                                    <button class="btn-supprimer">Supprimer</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Bernard Lucas</td>
                            <td>LucasB</td>
                            <td>lucasb@exemple.com</td>
                            <td>06 44 55 77 88</td>
                            <td>Support IT</td>
                            <td>Nantes, France</td>
                            <td>Oui</td>
                            <td>
                                <div class="btn-container">
                                    <button class="btn-modifier">Modifier</button>
                                    <button class="btn-supprimer">Supprimer</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Moreau Emma</td>
                            <td>EmmaDesign</td>
                            <td>emmoreau@exemple.com</td>
                            <td>06 11 22 33 44</td>
                            <td>Graphisme</td>
                            <td>Toulouse, France</td>
                            <td>Non</td>
                            <td>
                                <div class="btn-container">
                                    <button class="btn-modifier">Modifier</button>
                                    <button class="btn-supprimer">Supprimer</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Simon Antoine</td>
                            <td>TonyS</td>
                            <td>antoines@exemple.com</td>
                            <td>06 77 88 99 00</td>
                            <td>RH</td>
                            <td>Strasbourg, France</td>
                            <td>Oui</td>
                            <td>
                                <div class="btn-container">
                                    <button class="btn-modifier">Modifier</button>
                                    <button class="btn-supprimer">Supprimer</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>


    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>