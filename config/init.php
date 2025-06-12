<?php

$utilisateur_id = $_SESSION['id'];

$sql = "SELECT 
            u.utilisateur_nom, u.utilisateur_prenom, u.utilisateur_pseudo, 
            u.utilisateur_email, u.utilisateur_telephone, u.utilisateur_photo,
            u.utilisateur_conducteur, u.utilisateur_lieu,
            u.utilisateur_preference_fumeur, u.utilisateur_preference_nourriture, u.utilisateur_preference_musique,
            p.poste_nom,
            r.role_nom,
            u.role_id
        FROM utilisateur u
        LEFT JOIN poste p ON u.poste_id = p.poste_id
        LEFT JOIN role r ON u.role_id = r.role_id
        WHERE u.utilisateur_id = :id";

$stmt = $db->prepare($sql);
$stmt->execute(['id' => $utilisateur_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);