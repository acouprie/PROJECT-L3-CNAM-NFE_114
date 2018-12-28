<?php
session_start();
require("../scripts/bdd_connection.php");

# Check the mail & password before creating a PHP session
if (isset($_POST['mail']) && isset($_POST['password']))
{
    $request = $pdo->prepare('SELECT id, pseudo, password FROM user WHERE mail = ? LIMIT 1');
    $request->execute(array($_POST['mail']));
    $donnees = $request->fetch();
    # if password matches
    if (password_verify($_POST['password'], $donnees['password']))
    {
        $_SESSION['id'] = $donnees['id'];
        $_SESSION['pseudo'] = $donnees['pseudo'];
        $_SESSION['mail'] = $_POST['mail'];
        header('Location: ../wishlists.php');
    }
    # if login fail
    else
    {
        header('Location: ../index.php?login=false');
        exit();
    }
}
# if mail || password are not provided
else
{
    header('Location: ../index.php');
    exit();
}
?>
