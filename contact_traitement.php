<?php
include "../connection.php";

$nom = $_POST['nom'];
$email = $_POST['email'];
$sujet = $_POST['sujet'];
$message = $_POST['message'];

$stmt = mysqli_prepare($conn, "INSERT INTO messages_contact (nom, email, sujet, message) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssss", $nom, $email, $sujet, $message);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../pages/contact.php?success=1");
    exit();
} else {
    echo "Erreur : " . mysqli_error($conn);
}
?>