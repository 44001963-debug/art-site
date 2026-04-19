<?php
include "../connection.php";

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$biographie = $_POST['biographie'];

$portfolio_path = "";

if (isset($_FILES['portfolio_pdf']) && $_FILES['portfolio_pdf']['error'] === 0) {
    $file_name = $_FILES['portfolio_pdf']['name'];
    $tmp_name = $_FILES['portfolio_pdf']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if ($file_ext === "pdf") {
        $new_name = time() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "_", $file_name);
        $destination = "../uploads/" . $new_name;

        if (move_uploaded_file($tmp_name, $destination)) {
            $portfolio_path = "uploads/" . $new_name;
        } else {
            die("Erreur lors de l'envoi du fichier PDF.");
        }
    } else {
        die("Le fichier doit être un PDF.");
    }
} else {
    die("Veuillez ajouter un portfolio en PDF.");
}

$stmt = mysqli_prepare($conn, "INSERT INTO artistes (nom, prenom, email, telephone, portfolio, biographie) VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssssss", $nom, $prenom, $email, $telephone, $portfolio_path, $biographie);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../pages/rejoindre.php?success=1&nom=" . urlencode($prenom));
    exit();
} else {
    echo "Erreur lors de l'enregistrement : " . mysqli_error($conn);
}
?>