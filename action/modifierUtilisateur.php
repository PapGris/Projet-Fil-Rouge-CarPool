
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['utilisateur_id'])) {
    echo json_encode(['success' => false, 'message' => 'Données invalides.']);
    exit;
}

try {
    $nomPrenom = explode(' ', trim($data['nom_prenom']), 2);
    $nom = $nomPrenom[0];
    $prenom = $nomPrenom[1] ?? '';

    $sql = "UPDATE utilisateur SET
                utilisateur_nom = :nom,
                utilisateur_prenom = :prenom,
                utilisateur_pseudo = :pseudo,
                utilisateur_email = :email,
                utilisateur_telephone = :telephone,
                utilisateur_lieu = :lieu,
                utilisateur_conducteur = :conducteur
            WHERE utilisateur_id = :id";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'pseudo' => $data['pseudo'],
        'email' => $data['email'],
        'telephone' => $data['telephone'],
        'lieu' => $data['lieu'],
        'conducteur' => $data['conducteur'],
        'id' => $data['utilisateur_id']
    ]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
