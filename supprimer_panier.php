<?php
session_start();

if (isset($_GET['index']) && isset($_SESSION['panier'][$_GET['index']])) {
    unset($_SESSION['panier'][$_GET['index']]);
    $_SESSION['panier'] = array_values($_SESSION['panier']);
}

header("Location: ../pages/panier.php");
exit();