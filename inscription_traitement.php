<?php
include "../connection.php";

$nom = $_POST['nom'];
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

$mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

$sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe)
        VALUES ('$nom', '$email', '$mot_de_passe_hash')";

if (mysqli_query($conn, $sql)) {
    header("Location: ../pages/connexion.php");
    exit();
} else {
    echo "Erreur : " . mysqli_error($conn);
}
?>