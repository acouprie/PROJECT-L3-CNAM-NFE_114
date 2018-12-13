<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=christmas_wishlist;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

if (isset($_POST['mail']) && isset($_POST['password']))
{
    $request = $bdd->prepare('SELECT pseudo, password FROM user WHERE mail = ? LIMIT 1');
    $request->execute(array($_POST['mail']));
    $donnees = $request->fetch();
    if (password_verify($_POST['password'], $donnees['password']))
    {
        echo "Bienvenue " . $donnees['pseudo'];
    }
    else
    {
        header('Location: index.php?login=false');
        exit();
    }
}
else
{
    header('Location: index.php');
    exit();
}
?>