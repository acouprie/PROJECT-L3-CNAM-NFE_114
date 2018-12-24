<?php
session_start();
if (!isset($_SESSION['id']) ||
    !isset($_SESSION['pseudo']) ||
    !isset($_SESSION['mail']))
{
  header('Location: ../index.php');
}
require("../bdd_connection.php");
require("./new.html");

function DisplayError()
{
    echo "Une erreur est survenue, veuillez rééssayer. <br />
          Si l'erreur persiste, contactez l'administrateur à admin@example.com";
}

function ValidateName($name) {
    if (isset($name) &&
        preg_match("/^[a-zA-Z0-9_.-]*$/",$name) &&
        strlen($name) > 2 &&
        strlen($name) < 33)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function extractWishes()
{
    $next_wish = true;
    $wishes = [];
    $i = 1;
    while ($next_wish)
    {
        if (isset($_POST['wish_' . $i]))
        {
            $wishes[] = $_POST['wish_' . $i];
        }
        else
        {
            $next_wish = false;
        }
        $i++;
    }

    return $wishes;
}

function saveWish($wishlist_id)
{
    global $pdo;
    $wishes = extractWishes();
    $arrlength = count($wishes);
    for($x = 0; $x < $arrlength; $x++) {
        $request = $pdo->prepare('INSERT INTO wish(name, wishlist_id) VALUES(:name, :wishlist_id)');
        $request->execute(array(
            'name' => $wishes[$x],
            'wishlist_id' => $wishlist_id
        ));
    }
}

function saveWishlist()
{
    global $pdo;
    $request = $pdo->prepare('INSERT INTO wishlist(user_id, name) VALUES(:user_id, :name)');
    $request->execute(array($_SESSION['id'], $_POST['name']));
    $wishlist_id = $request->fetch()['id'];
    $request->closeCursor();
    $request = $pdo->prepare('SELECT id FROM wishlist WHERE user_id = ? AND name = ? LIMIT 1');
    $request->execute(array($_SESSION['id'], $_POST['name']));
    $wishlist_id = $request->fetch()['id'];
    $request->closeCursor();
    saveWish($wishlist_id);
}

function ValidateFields($name)
{
    if (ValidateName($name))
    {
        return true;
    }
    else
    {
        DisplayError();
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    ValidateFields ($_POST['name']))
{
    saveWishlist();
    exit();
}
?>
