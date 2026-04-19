<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = "panier";
    $_SESSION['pending_panier_item'] = [
        "titre" => $_POST['titre'],
        "image" => $_POST['image'],
        "prix" => $_POST['prix']
    ];

    header("Location: ../pages/connexion.php?login_required=1");
    exit();
}

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$item = [
    "titre" => $_POST['titre'],
    "image" => $_POST['image'],
    "prix" => $_POST['prix']
];

$_SESSION['panier'][] = $item;

header("Location: ../pages/panier.php");
exit();
?>

