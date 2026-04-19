<?php




session_start();
include "../connection.php";

$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

$sql = "SELECT * FROM utilisateurs WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nom'] = $user['nom'];

        if (isset($_SESSION['pending_panier_item'])) {
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = [];
            }

            $_SESSION['panier'][] = $_SESSION['pending_panier_item'];
            unset($_SESSION['pending_panier_item']);
        }

        if (isset($_SESSION['redirect_after_login']) && $_SESSION['redirect_after_login'] === "panier") {
            unset($_SESSION['redirect_after_login']);
            header("Location: ../pages/panier.php");
            exit();
        }

        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../pages/connexion.php?erreur=mdp");
        exit();
    }
} else {
    header("Location: ../pages/connexion.php?erreur=email");
    exit();
}
?>