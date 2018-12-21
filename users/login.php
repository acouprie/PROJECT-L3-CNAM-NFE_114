<?php
session_start();
require("../bdd_connection.php");

if (isset($_POST['mail']) && isset($_POST['password']))
{
    $request = $pdo->prepare('SELECT id, pseudo, password FROM user WHERE mail = ? LIMIT 1');
    $request->execute(array($_POST['mail']));
    $donnees = $request->fetch();
    if (password_verify($_POST['password'], $donnees['password']))
    {
        $_SESSION['id'] = $donnees['id'];
        $_SESSION['pseudo'] = $donnees['pseudo'];
        $_SESSION['mail'] = $_POST['mail'];
        header('Location: ../wishlists.php');
    }
    else
    {
        header('Location: ../index.php?login=false');
        exit();
    }
}
else
{
    header('Location: ../index.php');
    exit();
}
?>
